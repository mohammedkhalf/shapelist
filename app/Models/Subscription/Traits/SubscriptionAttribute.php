<?php

namespace App\Models\Subscription\Traits;

/**
 * Class SubscriptionAttribute.
 */
trait SubscriptionAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/6.x/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> '
                .$this->getEditButtonAttribute("edit-subscription", "admin.subscriptions.edit").'
               '.$this->getDeleteButtonAttribute("delete-subscription", "admin.subscriptions.destroy").'
                </div>';
    }
}
