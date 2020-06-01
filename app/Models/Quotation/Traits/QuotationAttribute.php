<?php

namespace App\Models\Quotation\Traits;

/**
 * Class QuotationAttribute.
 */
trait QuotationAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> {$this->getEditButtonAttribute("edit-quotation", "admin.quotations.edit")}
                {$this->getDeleteButtonAttribute("delete-quotation", "admin.quotations.destroy")}
                </div>';
    }
}
