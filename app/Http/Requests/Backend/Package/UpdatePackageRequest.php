<?php

namespace App\Http\Requests\Backend\Package;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FilterStringRule;
use App\Models\Product\Product;

class UpdatePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-package');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => ['required','string','max:50' , new FilterStringRule],
            'name_en' => ['required','string','max:50' , new FilterStringRule],
            'product_id.*' => ['required', 'integer','exists:'. Product::table() .',id'],
            'quantity.*' => ['required','integer'],
            'price' =>['required','numeric','not_in:0'],
            'desc_ar' =>['nullable' , new FilterStringRule],
            'desc_en' =>['nullable', new FilterStringRule]
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
