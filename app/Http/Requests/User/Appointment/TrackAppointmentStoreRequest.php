<?php

namespace App\Http\Requests\User\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class TrackAppointmentStoreRequest extends FormRequest
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
            'phone' => ['required', 'regex:/^(0098|0|\+98)9[0-9]{9}$/', 'exists:appointments,phone'],
            'tracking_code' => ['required', 'integer', 'exists:appointments,tracking_code']
        ];
    }
}
