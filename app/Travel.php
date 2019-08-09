<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
  // Table name
  protected $table = 'travels';
  // Primary key
  public $primaryKey = 'id';
  // Timestamps
  public $timestamps = true;

  public function user(){
      return $this->belongsTo('App\User');
  }
}
