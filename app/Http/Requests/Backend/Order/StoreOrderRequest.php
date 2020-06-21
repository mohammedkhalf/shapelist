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
            'total_price'=>['required' ,'numeric' , 'not_in:0'],
            'coupon_code' => ['string','max:10' ,  new FilterStringRule , 'nullable'],
            'on_set' =>['date_format:Y-m-d H:i:s' , 'nullable'],
            'country'=>['string',new FilterStringRule , 'nullable'],
            'city'=>['string',new FilterStringRule , 'nullable'], 
            'address' =>['string', new FilterStringRule , 'nullable'],
            'lat' =>['string', new FilterStringRule , 'nullable'],
            'lng' =>['string', new FilterStringRule , 'nullable'],
            'rep_first_name'=>['string', new FilterStringRule , 'nullable'],
            'rep_last_name'=>['string', new FilterStringRule , 'nullable'],
            'rep_phone_number'=>['numeric','regex:/(0)[0-9]{9}/' , 'nullable'], 
            //products array
            'products.*.product_id' => ['required' , 'numeric' , 'not_in:0' , 'exists:'. Product::table() .',id'],
            'products.*.product_quantity' => ['required' , 'numeric' , 'not_in:0'],
            'products.*.product_total_price' => ['numeric','not_in:0'],
            'products.*.video_length' => ['nullable','numeric','not_in:0'],
            'products.*.music_id' => ['nullable','numeric' , 'not_in:0' , 'exists:'. MusicSample::table() .',id'],
            'products.*.user_music' => ['nullable','mimes:mpga,ogg'],
            //package array
            'packages.*.package_id'=>['numeric','not_in:0','exists:'. Package::table() .',id'],
            'packages.*.quantity'=>['numeric','not_in:0'],
            'packages.*.vedio_length' => ['nullable','numeric','not_in:0'],
            'packages.*.package_music_id' => ['nullable','numeric' , 'not_in:0' , 'exists:'. MusicSample::table() .',id'],
            'packages.*.package_user_music' => ['nullable','mimes:mpga,ogg'],
        ];
    }

    public function messages()
    {
        return [
       
        ];
    }
}
