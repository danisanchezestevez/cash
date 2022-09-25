<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const TYPE_SELECT ="select";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'detail'
    ];

    public function question_category(){
        return $this->hasMany(CategoryQuestion::class, 'id');
    }

    public function brand(){
        return $this->hasMany(Brand::class, 'id');
    }
}
