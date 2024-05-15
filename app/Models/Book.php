<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'total_rate',
        'sub_category_id'
    ];


    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function ratings()
    {
        return $this->belongsToMany(User::class, 'ratings')->withPivot('rate');
    }
    
    public function favorits()
    {
        return $this->belongsToMany(User::class, 'faovorits');
    }
}
