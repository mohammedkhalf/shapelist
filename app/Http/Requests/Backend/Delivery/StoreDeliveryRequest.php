<?php

namespace App\Http\Requests\Backend\Delivery;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FilterStringRule;
class StoreDeliveryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('store-delivery');
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
            'name_en' => ['string','max:50' , new FilterStringRule],
            'name_ar' => ['string','max:50' , new FilterStringRule],
            'description_en' => ['nullable','string','max:250' , new FilterStringRule],
            'description_ar' => ['nullable','string','max:250' , new FilterStringRule],
            'price' => ['numeric'],
            'price_ar' => ['string',new FilterStringRule],
            'capacity'=>['required','integer'],
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
