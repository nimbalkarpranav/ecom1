<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_product extends Model
{
    use HasFactory;
    protected $table="tbl_product";
    public function category()
    {
        return $this->belongsTo(tbl__category::class, 'category_id');
    }


}
