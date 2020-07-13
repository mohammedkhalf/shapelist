<?php

namespace App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'order_id','file_name'
    ];

}
