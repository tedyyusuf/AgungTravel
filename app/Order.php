<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Table name
    protected $table = 'orders';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
      'title',
      'first_name',
      'last_name',
      'email',
      'phone_number',
      'paket',
      'day',
      'month',
      'year',
      'person',
      'payments',
      'order_status'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
