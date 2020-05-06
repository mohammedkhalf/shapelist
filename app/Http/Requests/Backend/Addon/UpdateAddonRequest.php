<?php

namespace App\Http\Requests\Backend\Addon;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FilterStringRule;

class UpdateAddonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-addon');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_en' => ['string','max:50', new FilterStringRule],
            'name_ar' => ['string','max:50' , new FilterStringRule],
            'description_en'=>['string','max:50' , new FilterStringRule],
            'description_ar'=>['string','max:50' , new FilterStringRule],
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
