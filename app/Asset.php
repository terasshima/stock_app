<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Asset extends Model
{
  public function user(){
    return $this->belongTo('App\User');
  }
}
