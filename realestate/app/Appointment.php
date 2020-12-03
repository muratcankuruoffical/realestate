<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable = ['appointmentAdress', 'appointmentDate', 'appointmentAddressDistance', 'customerFullName', 'customerEmail', 'customerPhoneNumber'];
}
