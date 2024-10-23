<?php

namespace App\Models;

use App\Models\FridayCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FridayItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(FridayCategory::class, 'category_id');
    }
}
