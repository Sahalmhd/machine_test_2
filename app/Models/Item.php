<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['itemname', 'qty', 'price', 'status'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'itemid_fk');
    }
}
