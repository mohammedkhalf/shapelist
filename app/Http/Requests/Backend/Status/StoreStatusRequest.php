<?php

namespace App\Http\Requests\Backend\Status;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FilterStringRule;

class StoreStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('store-status');
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
            'type' => ['string','max:50',new FilterStringRule],
            'type_ar'=> ['string','max:50',new FilterStringRule],
            'icon'=> ['mimes:jpeg,png,jpg,svg','max:50240']


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
