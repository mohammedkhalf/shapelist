<?php

namespace App\Http\Requests\Backend\Cart;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\MusicSample\MusicSample;
use App\Rules\FilterStringRule;
class StoreCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return access()->allow('store-cart');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item_id'=>['required','numeric','not_in:0'],
            'quantity'=>['numeric','not_in:0'],
            'price_per_item'=>['numeric','not_in:0'],
            'items_total_price'=>['numeric','not_in:0'],
            'music_id'=>['nullable','numeric' , 'not_in:0' , 'exists:'. MusicSample::table() .',id'],
            'video_length' => ['numeric','not_in:0'],
            'user_music' => ['nullable','mimes:mpga,ogg'],
            'type'=>['required','string', new FilterStringRule],
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
