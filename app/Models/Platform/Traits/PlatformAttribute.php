<?php

namespace App\Models\Platform\Traits;

/**
 * Class PlatformAttribute.
 */
trait PlatformAttribute
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
                '.$this->getEditButtonAttribute("edit-platform", "admin.platforms.edit").'
                '.$this->getDeleteButtonAttribute("delete-platform", "admin.platforms.destroy").'
                </div>';
    }
}
