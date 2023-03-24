<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'             => ['required', 'unique:apartments', 'max:255'],
            'description'       => ['nullable'],
            'room_n'            => ['required', 'max:4'],
            'bed_n'             => ['required', 'max:4'],
            'bath_n'            => ['required', 'max:4'],
            'square_meters'     => ['required', 'max:11'],
            'address'           => ['required', 'max:255'],
            'visible'           => ['required'],
            'cover_img'         => ['nullable', 'max:255']
        ];
    }
}
