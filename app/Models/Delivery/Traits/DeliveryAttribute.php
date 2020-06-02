<?php

namespace App\Models\Delivery\Traits;

/**
 * Class DeliveryAttribute.
 */
trait DeliveryAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-delivery", "admin.deliveries.edit")}
                {$this->getDeleteButtonAttribute("delete-delivery", "admin.deliveries.destroy")}
                </div>';
    }
}
