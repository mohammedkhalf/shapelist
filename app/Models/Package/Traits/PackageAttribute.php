<?php

namespace App\Models\Package\Traits;

/**
 * Class PackageAttribute.
 */
trait PackageAttribute
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
                '.$this->getEditButtonAttribute("edit-package", "admin.packages.edit").'
                '.$this->getDeleteButtonAttribute("delete-package", "admin.packages.destroy").'
                </div>';
    }
}
