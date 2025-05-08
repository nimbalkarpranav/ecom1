<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderChild extends Model
{
    use HasFactory;

    protected $table='tbl_order_order_child';
    public function product()
    {
        return $this->belongsTo(tbl_product::class, 'oc_product_id');
    }
    protected $fillable = [
        'oc_master_id',
        'oc_product_id',
        'oc_master_qut',
        'oc_total_price'
    ];

}
