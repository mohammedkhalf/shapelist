<?php

namespace App\Models\Template\Traits;

/**
 * Class TemplateAttribute.
 */
trait TemplateAttribute
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
                '.$this->getEditButtonAttribute("edit-template", "admin.templates.edit").'
                '.$this->getDeleteButtonAttribute("delete-template", "admin.templates.destroy").'
                </div>';
    }
}
