<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GallaryItem extends Model
{
    use HasFactory;
    protected $table = "gallary_items";
    protected $guarded = [];
}
