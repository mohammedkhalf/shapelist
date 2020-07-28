<?php

namespace App\Http\Requests\Backend\Product;
use App\Rules\FilterStringRule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-product');
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
            'name' => ['string' , 'max:50' , new FilterStringRule],
            'name_ar' => ['string' , 'max:50' , new FilterStringRule],
            'description' => ['string' , 'max:255'],
            'description_ar' => ['string' , 'max:255'],
            'image' => ['mimes:jpeg,png,jpg,svg','max:50240'],
            'price' => ['numeric','not_in:0'],
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
