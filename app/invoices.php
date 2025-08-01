<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name' ,
        'day_of_pay',
        'invoice_date',
        'total_buy',
        'intro_cash',
        'total_remain' ,
        'customer_id' ,
        'pay_date' ,
        'status' ,
        'qist' ,
        'note',
    ];


    protected $dates = ['deleted_at'];


   public function customers()
   {
    return $this->belongsTo(Customer::class,'customer_id');
   }
}
