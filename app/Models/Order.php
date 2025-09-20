<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table="tbl_order_master";
        protected $fillable = [
        'name',
        'order_m_customer_id',
        'order_m_total_price',
        'order_m_adderss',
        'order_m_date',
        'total',
        'payment_method',
        'payment_status',
        'order_status',
    ];
    //public function products()
    public function products()
    {
        return $this->hasMany(OrderChild::class, 'oc_master_id');
    }
 public function user()
{
    return $this->belongsTo(User::class, 'order_m_customer_id');
}

}
