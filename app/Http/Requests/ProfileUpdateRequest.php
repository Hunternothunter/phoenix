<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable','string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'birthdate' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'string', 'max:25'],
            'mobile_num' => ['nullable', 'string', 'max:30'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'username' => ['required', 'string', 'max:16', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
