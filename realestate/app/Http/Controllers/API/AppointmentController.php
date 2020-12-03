<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    //
    public function addAppointment(Request $request) {
        $validator = Validator::make($request->all(),[
            'appointmentAddress' => 'required|string',
            'appointmentDate' => 'required|date_format:d.m.Y H:i:s',
            'appointmentAddressDistance' => 'required',
            'customerFullName' => 'required|string',
            'customerEmail' => 'required|string|email|max:255',
            'customerPhoneNumber' => 'required|integer',
            'estimatedTimeOfArrival' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }
        $user = Auth::user();
        $appointment = $user->appointments()->create([
            'appointmentAddress' => $request->input('appointmentAddress'),
            'appointmentDate' => $request->input('appointmentDate'),
            'appointmentAddressDistance' => $request->input('appointmentAddressDistance'),
            'customerFullName' => $request->input('customerFullName'),
            'customerEmail' => $request->input('customerEmail'),
            'customerPhoneNumber' => $request->input('customerPhoneNumber'),
            'estimatedTimeOfArrival' => $request->input('estimatedTimeOfArrival')

        ]);
        return response()->json(['message' => 'appointment succesfully added.', 'appointment' => $appointment, 'user' => $user], 200);
    }
    public function getAppointments() {
        $user = Auth::user();
        $appointments = $user->appointments()->get();
        return response()->json(['message' => 'message', 'appointments' => $appointments]);
    }
    public function getAppointment($id){
        $user = Auth::user();
        $appointment = $user->appointments()->find($id);
        return response()->json(['message' => 'message', 'appointment' => $appointment]);
    }
    public function updateAppointment($id,Request $request){
        $validator = Validator::make($request->all(),[
            'appointmentAddress' => 'required|string',
            'appointmentDate' => 'required|date_format:d.m.Y H:i:s',
            'appointmentAddressDistance' => 'required',
            'customerFullName' => 'required|string',
            'customerEmail' => 'required|string|email|max:255',
            'customerPhoneNumber' => 'required|integer',
            'estimatedTimeOfArrival' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }
        $user = Auth::user();
        $appointment = $user->appointments()->find($id);
        $appointment->update($request->all());
        return response()->json(['message' => 'success', 'appointment' => $appointment],200);
    }
}
