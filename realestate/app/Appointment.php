<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable = ['appointmentAddress', 'appointmentDate', 'appointmentAddressDistance', 'customerFullName', 'customerEmail', 'customerPhoneNumber', 'estimatedTimeOfArrival'];
}
