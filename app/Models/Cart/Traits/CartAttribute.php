<?php

namespace App\Models\Cart\Traits;

/**
 * Class CartAttribute.
 */
trait CartAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-cart", "admin.carts.edit")}
                {$this->getDeleteButtonAttribute("delete-cart", "admin.carts.destroy")}
                </div>';
    }
}
