<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pizza extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'image', 'price', 'discount_price', 'publish_status', 'buy_one_get_one_status', 'waiting_time', 'description'];

}
