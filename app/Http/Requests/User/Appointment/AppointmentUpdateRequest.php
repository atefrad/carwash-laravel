<?php

namespace App\Http\Requests\User\Appointment;

use App\Models\Service;
use App\Rules\TimeAvailable;
use App\Traits\TimeSlotsNeeded;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AppointmentUpdateRequest extends FormRequest
{
    use TimeSlotsNeeded;

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
            ['time' => $times]
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $timeSlotsNeeded = $this->calculateTimeSlotsNeeded(request('services'));

        return [
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['required', 'integer', 'exists:services,id'],
            'time' => ['required', 'array', 'size:' . $timeSlotsNeeded],
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
                'total_price' => $totalPrice
            ]
        );
    }

    public function messages()
    {
        return array_merge(
            parent::messages(),
            ['time.size' => 'The :attribute is not valid!']
        );
    }
}
