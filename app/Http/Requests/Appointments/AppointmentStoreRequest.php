<?php

namespace App\Http\Requests\Appointments;

use App\Models\Appointment;
use App\Models\Service;
use App\Rules\BetweenNineAndTwentyOne;
use App\Rules\TimeAvailable;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
//            'name' => ['required', 'string', 'min:3'],
//            'phone' => ['required', 'string', 'regex:/^(0098|0|\+98)9[0-9]{9}$/'],
//            'service_id' => ['required', 'integer', 'min:1', 'max:3'],
//            'start_time' => ['required_without:fastest_time', new BetweenNineAndTwentyOne, new TimeAvailable],
////            'station_id' => ['nullable', 'integer']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $serviceDuration = Service::query()
            ->where('id', request('service_id'))
            ->first()->duration;

        if(is_null(request('start_time')))
        {
            $startTime = request('fastest_time');

            $station = request('station');

        }else{

            $startTime = request('start_time');

            $appointment = Appointment::query()
                ->where('start_time', request('start_time'))
                ->where('station', 1)
                ->first();

            $station = $appointment ? 2 : 1;
        }

        $finishTime = Date( "Y-m-d H:i:s",strtotime($startTime) + $serviceDuration * 60);

        return array_merge(
            parent::validated(),
            [
                'finish_time' => $finishTime,
                'station' => $station,
                'start_time' => $startTime,
                'tracking_code' => rand(100000, 999999)
            ]
        );

    }
}
