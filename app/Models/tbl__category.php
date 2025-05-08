<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl__category extends Model
{
    use HasFactory;

    protected $table="tbl_cat";
    public function products()
{
    return $this->hasMany(tbl_product::class, 'category_id');
}

}
