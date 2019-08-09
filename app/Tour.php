<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
  // Table name
  protected $table = 'tours';
  // Primary key
  public $primaryKey = 'id';
  // Timestamps
  public $timestamps = true;

  public function user(){
      return $this->belongsTo('App\User');
  }
}
