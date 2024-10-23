<?php

namespace App\Models;

use App\Models\FridayCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FridayCollection extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->hasMany(FridayCategory::class, 'collection_id');
    }
}
