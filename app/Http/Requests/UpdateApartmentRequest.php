<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateApartmentRequest extends FormRequest
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
            'title'             => ['required', Rule::unique('apartments')->ignore($this->apartment), 'max:255'],
            'description'       => ['nullable'],
            'room_n'            => ['required', 'max:4'],
            'bed_n'             => ['required', 'max:4'],
            'bath_n'            => ['required', 'max:4'],
            'square_meters'     => ['required', 'max:11'],
            'address'           => ['required', 'max:255'],
            'visible'           => ['required'],
            'cover_img'         => ['nullable', 'image', 'max:255']
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è richiesto',
            'title.unique' => 'Questo titolo è già presente',
            'title.max' => 'Il titolo non deve superare i 255 caratteri',
            'room_n.required' => 'Numero rischiesto',
            'room_n.max' => 'Il numero di stanze non deve superare le 4 cifre',
            'bed_n.required' => 'Numero rischiesto',
            'bed_n.max' => 'Il numero di letti non deve superare le 4 cifre',
            'bath_n.required' => 'Numero rischiesto',
            'bath_n.max' => 'Il numero di bagni non deve superare le 4 cifre',
            'square_meters.required' => 'Numero rischiesto',
            'square_meters.max' => 'I metri quadri non possono superare le 11 cifre',
            'address.required' => 'Indirizzo rischiesto',
            'address.max' => 'L\'indirizzo non deve superare i 255 caratteri',
            'cover_img.image' => 'Inserire un formato di immagine valido',
            'cover_img.required' => 'Copertina rischiesta',
            'cover_img.max' => 'L\'immagine non deve superare i 255 kilobytes'
        ];
    }
}
