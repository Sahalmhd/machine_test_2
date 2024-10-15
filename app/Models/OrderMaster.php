<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    use HasFactory;

    protected $table = 'ordermaster';


    // Define the fillable columns
    protected $fillable = [
        'customername',
        'address',
        'phone',
        'mobile',
        'orderdate',
        'totalamount',
        'orderstatus',
    ];

    public function order()
    {
        return $this->belongsTo(OrderMaster::class, 'orderid_fk');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemid_fk');
    }
}
