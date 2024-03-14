<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

//    protected $with = [
//        'appointments'
//    ];

    //region relation
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    //endregion

    //region accessor
    protected function totalPayments(): Attribute
    {
        return Attribute::make(
            get: function () {

                $totalPayments = 0;

                foreach($this->appointments as $appointment)
                {
                    $totalPayments += $appointment->total_price;
                }

                return $totalPayments;
            },
        );
    }

    protected function lastUse(): Attribute
    {
        return Attribute::make(
            get: function () {

               $lastUse = 0;

                foreach($this->appointments as $appointment)
                {
                    if(strtotime($appointment->times[0]->date_time) > strtotime($lastUse))
                    {
                        $lastUse = $appointment->times[0]->date_time;
                    }
                }

                if(!$lastUse) return '';

                return $lastUse;
            }
        );
    }

    protected function activity(): Attribute
    {
        return Attribute::make(
            get: function () {

                $threeMonthAgo = Carbon::parse(strtotime('-3 month'))
                    ->format('Y-m-d H:i:s');

                return $this->appointments()
                    ->where('appointments.created_at', '>', $threeMonthAgo)
                    ->count();
            }
        );
    }
    //endregion
}
