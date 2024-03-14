<?php

namespace App\Http\Requests\Appointments;

use App\Models\Appointment;
use App\Models\Service;
use App\Rules\BetweenNineAndTwentyOne;
use App\Rules\TimeAvailable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AppointmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $times = array_filter(explode(',', request('time')));

        $this->merge(
            [
                'time' => $times
            ]
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
//            'name' => ['required', 'string', 'min:3'],
//            'phone' => ['required', 'string', 'regex:/^(0098|0|\+98)9[0-9]{9}$/'],
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['required', 'integer', 'exists:services,id'],
            'time' => ['required', 'array', 'min:1'],
            'time.*' => ['required', 'integer', 'exists:times,id', new TimeAvailable]
        ];
    }

    public function validated($key = null, $default = null)
    {
        $totalPrice = 0;

        foreach (request('services') as $serviceId)
        {
            $totalPrice += Service::query()->find($serviceId)->price;
        }

        return array_merge(
          parent::validated(),
          [
              'user_id' => Auth::id(),
              'total_price' => $totalPrice,
              'tracking_code' => rand(100000, 999999)
          ]
        );
    }
}
