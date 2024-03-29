<?php

namespace App\Http\Requests\Manager\Service;

use App\Rules\ValidDuration;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255',
                Rule::unique('services')->ignore($this->route('service'))],
            'duration' => ['required', 'integer', new ValidDuration],
            'price' => ['required', 'integer', 'min:10000']
        ];
    }
}
