<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
     //
     public function user()
     {
         return $this->belongsTo(User::class);
     }

      //
      public function shipping()
      {
          return $this->belongsTo(Order::class);
      }
}
