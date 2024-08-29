<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ensure the user is authorized
    }
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'profile_picture' => ['nullable', 'image', 'max:1024'], // 1MB max size
        ];
    }


}
