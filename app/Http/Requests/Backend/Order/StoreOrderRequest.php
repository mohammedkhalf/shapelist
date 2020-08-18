<?php

namespace App\Http\Requests\Backend\Order;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product\Product;
use App\Models\Delivery\Delivery;
use App\Models\Location\Location;
use App\Models\MusicSample\MusicSample;
use App\Rules\FilterStringRule;
use App\Models\Package\Package; 
use App\Rules\FilterPhoneNumber;

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
            'delivery_id'=>['numeric','not_in:0','exists:'. Delivery::table() .',id'],
            'delivery_price'=>['numeric','min:0'],
            'coupon_code' => ['string',new FilterStringRule , 'nullable'],
            'onset' => ['nullable','numeric','min:0'],
            'totalOnset'=>['nullable','numeric','min:0'],
            'totalPrice'=>['nullable','numeric','min:0'],
            'vat' =>['nullable','numeric','min:0'],
            'totalVat'=>['nullable','numeric','min:0'],
            'grandTotal'=>['numeric','min:0'],
            //product array
            'products.*.dates' => ['array'],
            'products.*.services' => ['required','string',new FilterStringRule],
            'products.*.quantity' => ['numeric','integer','not_in:0'],
            'products.*.productType' => ['string',new FilterStringRule,'nullable'],
            'products.*.totalPrice' => ['required','numeric','not_in:0'],
            //location
            '*.country'=>[new FilterStringRule , 'nullable'],
            '*.city'=>[new FilterStringRule , 'nullable'], 
            '*.address' =>[new FilterStringRule , 'nullable'],
            '*.postal_code' =>[new FilterStringRule , 'nullable'],
            '*.unit_no' =>[new FilterStringRule , 'nullable'],
            '*.lat' =>[new FilterStringRule , 'nullable'],
            // '*.lng' =>['string','nullable'],
            '*.rep_first_name'=>[new FilterStringRule , 'nullable'],
            '*.rep_last_name'=>[new FilterStringRule , 'nullable'],
            '*.rep_phone_number'=>['numeric','not_in:0'],'nullable',
            '*.state'=>[new FilterStringRule , 'nullable'],
            '*.unit_no'=>['numeric','nullable'],
        ];
    }

    public function messages()
    {
        return [
       
        ];
    }
}
