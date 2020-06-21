<?php

namespace App\Http\Requests\Backend\MusicSample;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMusicSampleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-musicsample');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Put your rules for the request in here
            //For Example : 'title' => 'required'
            //Further, see the documentation : https://laravel.com/docs/5.4/validation#creating-form-requests
            'name' => ['string','regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/','max:50'],
            'type' => ['string','regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/','max:50'],
            'url' => ['mimes:mpga,wav,wma','max:50240'],
        ];
    }

    public function messages()
    {
        return [
            //The Custom messages would go in here
            //For Example : 'title.required' => 'You need to fill in the title field.'
            //Further, see the documentation : https://laravel.com/docs/5.4/validation#customizing-the-error-messages
        ];
    }
}
