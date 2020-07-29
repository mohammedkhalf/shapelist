<?php

namespace App\Http\Requests\Backend\Order;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product\Product;
use App\Models\Delivery\Delivery;
use App\Models\Location\Location;
use App\Models\MusicSample\MusicSample;
use App\Rules\FilterStringRule;
use App\Models\Package\Package; 

class StoreOrderRequest extends FormRequest
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
            'delivery_id'=>['required','numeric','not_in:0','exists:'. Delivery::table() .',id'],
            'location_id'=>['numeric','not_in:0','exists:'. Location::table() .',id' , 'nullable'],
            'total_price'=>['required','numeric','not_in:0'],
            'coupon_code' => ['string','max:10' ,  new FilterStringRule , 'nullable'],
            // 'on_set' =>['string','nullable',new FilterStringRule],
            '*.country'=>[new FilterStringRule , 'nullable'],
            '*.city'=>[new FilterStringRule , 'nullable'], 
            '*.address' =>[new FilterStringRule , 'nullable'],
            '*.zip' =>[new FilterStringRule , 'nullable'],
            '*.unit_no' =>[new FilterStringRule , 'nullable'],
            '*.lat' =>[new FilterStringRule , 'nullable'],
            '*.lang' =>[new FilterStringRule , 'nullable'],
            '*.name'=>[new FilterStringRule , 'nullable'],
            '*.phone_number'=>['numeric','regex:/(0)[0-9]{9}/' , 'nullable'], 
            
            'products.*.services' => ['required','array','exists:products,id'],
            'products.*.quantity' => ['numeric','integer','not_in:0'],
            'products.*.media_location' => ['string',new FilterStringRule,'nullable'],
        ];
    }

    public function messages()
    {
        return [
       
        ];
    }
}
