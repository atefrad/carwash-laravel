<?php

namespace App\Http\Requests\Manager;

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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^(0098|0|\+98)9[0-9]{9}$/', Rule::unique(User::class)->ignore($this->user())],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ];
    }
}
