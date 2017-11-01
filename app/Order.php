<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     //
     public function user()
     {
         return $this->belongsTo(User::class);
     }

     public function items()
     {
         return $this->hasMany(Item::class, 'order_id');
     }

     /**
     * Get the phone record associated with the user.
     */
      public function shipping()
      {
          return $this->hasOne('App\Shipping');
      }
}
