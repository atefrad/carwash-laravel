<?php

namespace App\Rules;

use App\Models\Appointment;
use App\Models\Service;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\App;

class TimeAvailable implements DataAwareRule,ValidationRule
{
    private array $data;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value)
        {
            $sameTimeAppointment = Appointment::query()
                ->where('start_time', $value)
                ->first();

//            $appointmentBefore = Appointment::query()
//                ->where('start_time', '<', $value)
//                ->orderBy('start_time', 'desc')->first();
//
//            $noAppointmentBeforeInteraction = strtotime($appointmentBefore->finish_time) < strtotime($value);
//
//            $appointmentAfter = Appointment::query()
//                ->where('start_time', '>', $value)
//                ->orderBy('start_time')
//                ->first();
//
//            $serviceID = $this->data['service_id'];
//
//            $serviceDuration = Service::query()
//                ->where('id', $serviceID)
//                ->first()
//                ->duration;
//
//            $noAppointmentAfterInteraction = strtotime($appointmentAfter->start_time) > (strtotime($value) * ($serviceDuration * 60));
//
//            if($sameTimeAppointment || !$noAppointmentAfterInteraction || !$noAppointmentBeforeInteraction)
//            {
//                $fail('Time is not available!');
//            }

            if ($sameTimeAppointment)
            {
                $fail('Time is not available!');
            }

        }


    }

    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }
}
