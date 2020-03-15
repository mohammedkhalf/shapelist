<?php
namespace App\Models;

trait SharedModel
{
  /**
   * Return Table Name
   */
   public static function table()
   {
       return with(new static)->getTable();
   }
}
