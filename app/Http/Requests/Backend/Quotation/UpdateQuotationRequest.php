<?php

namespace App\Http\Requests\Backend\Quotation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuotationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-quotation');
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
            //Further, see the documentation : https://laravel.com/docs/6.x/validation#creating-form-requests
            'name' => ['string','regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/','max:50'],
            'price' => ['numeric','not_in:0'],
        ];
    }

    public function messages()
    {
        return [
            //The Custom messages would go in here
            //For Example : 'title.required' => 'You need to fill in the title field.'
            //Further, see the documentation : https://laravel.com/docs/6.x/validation#customizing-the-error-messages
        ];
    }
}
