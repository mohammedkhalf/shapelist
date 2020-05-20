<?php

namespace App\Models\Promotion\Traits;

/**
 * Class PromotionAttribute.
 */
trait PromotionAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-promotion", "admin.promotions.edit")}
                {$this->getDeleteButtonAttribute("delete-promotion", "admin.promotions.destroy")}
                </div>';
    }
}
