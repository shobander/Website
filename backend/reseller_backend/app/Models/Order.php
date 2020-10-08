<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Get Product record associated with the order
     */
    public function product(){
        return $this->hasOne("App\Models\Product");
    }
}
