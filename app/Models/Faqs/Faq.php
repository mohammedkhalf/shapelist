<?php

namespace App\Models\Faqs;

use App\Models\BaseModel;
use App\Models\Faqs\Traits\Attribute\FaqAttribute;
use App\Models\ModelTrait;
use App\Models\FaqCategory\FaqCategory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        FaqAttribute {
            // FaqAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['question', 'answer','question_ar', 'answer_ar', 'status','category_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('module.faqs.table');
    }

    public function category()
    {
        return $this->hasOne(FaqCategory::class,'category_id');   
    } 
}
