<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $table = 'orderItems';

    use HasFactory;

    protected $fillable = ['customername', 'address', 'phone', 'orderdate', 'mobile', 'totalamount', 'orderstatus'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'orderid_fk');
    }
}
