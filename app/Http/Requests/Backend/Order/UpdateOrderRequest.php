<?php

namespace App\Http\Requests\Backend\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-order');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['numeric' , 'not_in:0' , 'exists:'. User::table() .',id'],
            'product_id' => ['required' , 'numeric' , 'not_in:0' , 'exists:'. Product::table() .',id'],
            'platform_id' => [ 'numeric' , 'not_in:0' , 'exists:'. Platform::table() .',id'],
            'addon_id' => ['numeric' , 'not_in:0' , 'exists:'. Addon::table() .',id'],
            'music_id' => [ 'numeric' , 'not_in:0' , 'exists:'. MusicSample::table() .',id'],
            'template_id' => [ 'numeric' , 'not_in:0' , 'exists:'. Template::table() .',id'],
            'coupon_code' => ['string','max:10'],
            'product_quantity' => ['required' , 'numeric' , 'not_in:0'],
            'logo' => ['mimes:jpeg,png,jpg'],
            'video_length' => [ 'numeric' , 'not_in:0'],
            'notes' => ['string'],
            'country'=>[ 'string'],
            'city'=>[ 'string'],
            'address' =>['string'],
            'background' =>['numeric' , 'not_in:0'],
            'background_color'=>['string'],
            'delivery_id'=>['numeric' , 'not_in:0'],
            'user_music' => ['mimes:mpga,ogg']
         
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
