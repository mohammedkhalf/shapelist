<?php

namespace App\Http\Requests\Backend\Subscription;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FilterStringRule;

class UpdateSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-subscription');
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
            'name' => ['string','max:50' , new FilterStringRule],
            'name_ar' => ['string','max:50' , new FilterStringRule],
            'purchase_points' => ['numeric','not_in:0'],
            'free_points' => ['numeric','not_in:0'],
            'discount' => ['nullable','numeric','not_in:0'],
            'details' => ['nullable','string' , 'max:255', new FilterStringRule],
            'duration' => ['numeric','not_in:0'],  
            'price' => ['numeric','not_in:0'],
            'priority_support' => ['numeric','in:0,1' ],
            'delivery_id' => ['required','numeric','not_in:0'],
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
