<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qist extends Model
{
    protected $table = 'cash';
    protected $fillable = [
        'cash', 'invoice_id', 'date' 
    ];

    public function invoice()
    {
        return $this->belongsTo(invoices::class, 'invoice_id');
    }
}
