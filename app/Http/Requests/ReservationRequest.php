<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'name' => 'required',
            'nic' => 'required',
            'contact_no' => 'required|min:10',
            'reserve_date' => 'required',
            'travel_date' => 'required',
            'start_location' => 'required',
            'end_location' => 'required|different:start_location',
            'vehicle_no' => 'required',
            'seat_no' => 'required',

        ];
    }
}
