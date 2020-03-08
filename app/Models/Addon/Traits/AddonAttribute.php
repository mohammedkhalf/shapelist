<?php

namespace App\Models\Addon\Traits;

/**
 * Class AddonAttribute.
 */
trait AddonAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/5.4/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                '.$this->getEditButtonAttribute("edit-addon", "admin.addons.edit").'
                '.$this->getDeleteButtonAttribute("delete-addon", "admin.addons.destroy").'
                </div>';
    }
}
