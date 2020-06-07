<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Access\User\User;
use App\Models\Addon\Addon;
use App\Models\Coupon\Coupon;
use App\Models\MusicSample\MusicSample;
use App\Models\Platform\Platform;
use App\Models\Product\Product;
use App\Models\Template\Template;
use App\Models\Delivery\Delivery;
use App\Rules\FilterStringRule;

class StoreOrderFront extends FormRequest
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

 
    public function rules()
    {
        return [
            // 'delivery_id'=>['numeric','not_in:0','exists:'. Delivery::table() .',id'],
            // 'total_price'=>['numeric' , 'not_in:0'],
            // 'coupon_code' => ['string','max:10' ,  new FilterStringRule],
            // 'on_set' =>['date_format:Y-m-d H:i:s'],
            // 'country'=>['string',new FilterStringRule],
            // 'city'=>['string',new FilterStringRule],
            // 'address' =>['string', new FilterStringRule],
            // 'rep_first_name'=>['string', new FilterStringRule],
            // 'rep_last_name'=>['string', new FilterStringRule],
            // 'rep_phone_number'=>['numeric','regex:/(0)[0-9]{9}/'],

            // // 'product_id' => ['required' , 'numeric' , 'not_in:0' , 'exists:'. Product::table() .',id'],
            // // 'product_quantity' => ['required' , 'numeric' , 'not_in:0'],
            // // 'total_price' => ['numeric','not_in:0'],
            // // 'video_length' => ['numeric','not_in:0'],
            // // 'music_id' => [ 'numeric' , 'not_in:0' , 'exists:'. MusicSample::table() .',id'],
            // // 'user_music' => ['mimes:mpga,ogg']
        ];
    }
}
