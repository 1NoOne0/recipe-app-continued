<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Get the list of accepted friends where the current user is either user_id or friend_id
        $friendships = DB::table('friends')
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->orWhere('friend_id', $userId);
            })
            ->where('status', 'accepted')
            ->get();

        // Collect the friend user models
        $friends = $friendships->map(function ($friendship) use ($userId) {
            return $friendship->user_id == $userId ? User::find($friendship->friend_id) : User::find($friendship->user_id);
        });

        // Get the list of incoming friend requests
        $incomingRequests = DB::table('friends')
            ->where('friend_id', $userId)
            ->where('status', 'pending')
            ->get();

        // Collect the incoming friend request user models
        $incomingFriends = $incomingRequests->map(function ($friendship) {
            return User::find($friendship->user_id);
        });

        return view('friends.index', compact('friends', 'incomingFriends'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        // Find the friend by their email
        $friend = User::where('email', $request->friend_email)->first();

        if ($friend) {
            // Check if a friend request already exists
            $existingFriendship = DB::table('friends')
                ->where(function ($query) use ($friend, $userId) {
                    $query->where('user_id', $userId)
                          ->where('friend_id', $friend->id);
                })
                ->orWhere(function ($query) use ($friend, $userId) {
                    $query->where('user_id', $friend->id)
                          ->where('friend_id', $userId);
                })
                ->first();

            if ($existingFriendship) {
                return redirect()->back()->with('error', 'Friend request already sent or you are already friends.');
            }

            // Create the friendship record
            DB::table('friends')->insert([
                'user_id' => $userId,
                'friend_id' => $friend->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Friend request sent!');
        }

        return redirect()->back()->with('error', 'User not found.');
    }

    public function accept($friendId)
    {
        $userId = Auth::id();

        DB::table('friends')
            ->where('friend_id', $userId)
            ->where('user_id', $friendId)
            ->update(['status' => 'accepted', 'updated_at' => now()]);

        return redirect()->back()->with('success', 'Friend request accepted!');
    }

    public function decline($friendId)
    {
        $userId = Auth::id();

        DB::table('friends')
            ->where('friend_id', $userId)
            ->where('user_id', $friendId)
            ->delete();

        return redirect()->back()->with('success', 'Friend request declined.');
    }

    public function destroy($id)
    {
        // Use the query builder to delete the friendship
        $deleted = DB::table('friends')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Friendship removed successfully.');
        }

        return redirect()->back()->with('error', 'Friendship not found.');
    }
}
