<?php

namespace App\Models;

use App\Models\FridayItem;
use App\Models\FridayCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FridayCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function items()
    {
        return $this->hasMany(FridayItem::class, 'category_id');
    }

    public function collection()
    {
        return $this->belongsTo(FridayCollection::class, 'collection_id');
    }
}
