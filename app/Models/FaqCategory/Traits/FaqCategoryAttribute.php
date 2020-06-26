<?php

namespace App\Models\FaqCategory\Traits;

/**
 * Class FaqCategoryAttribute.
 */
trait FaqCategoryAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                '.$this->getEditButtonAttribute("edit-faqcategory", "admin.faqcategories.edit").'
                '.$this->getDeleteButtonAttribute("delete-faqcategory", "admin.faqcategories.destroy").'
                </div>';
    }
}
