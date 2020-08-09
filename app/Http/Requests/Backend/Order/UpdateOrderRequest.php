<?php

namespace App\Http\Requests\Backend\Order;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product\Product;
use App\Models\Delivery\Delivery;
use App\Models\Location\Location;
use App\Models\MusicSample\MusicSample;
use App\Rules\FilterStringRule;


class UpdateOrderRequest extends FormRequest
{
    /**  
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return access()->allow('update-order');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delivery_id'=>['required','numeric','not_in:0','exists:'. Delivery::table() .',id'],
            'location_id'=>['numeric','not_in:0','exists:'. Location::table() .',id' , 'nullable'],
            'total_price'=>['required','numeric','not_in:0'],
            'coupon_code' => ['string','max:10' ,  new FilterStringRule , 'nullable'],
            'products.*.services' => ['required','string',new FilterStringRule],
            'products.*.quantity' => ['numeric','integer','not_in:0'],
            'products.*.productType' => ['string',new FilterStringRule,'nullable'],
            '*.country'=>[new FilterStringRule , 'nullable'],
            '*.city'=>[new FilterStringRule , 'nullable'], 
            '*.address' =>[new FilterStringRule , 'nullable'],
            '*.postal_code' =>[new FilterStringRule , 'nullable'],
            '*.unit_no' =>[new FilterStringRule , 'nullable'],
            '*.lat' =>[new FilterStringRule , 'nullable'],
            // '*.lng' =>['string','nullable'],
            '*.rep_first_name'=>[new FilterStringRule , 'nullable'],
            '*.rep_phone_number'=>['numeric','not_in:0'],
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
