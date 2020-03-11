<?php

namespace App\Models\MusicSample\Traits;

/**
 * Class MusicSampleAttribute.
 */
trait MusicSampleAttribute
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
                '.$this->getEditButtonAttribute("edit-musicsample", "admin.musicsamples.edit").'
                '.$this->getDeleteButtonAttribute("delete-musicsample", "admin.musicsamples.destroy").'
                </div>';
    }
}
