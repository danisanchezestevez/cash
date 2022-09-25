<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = "brands";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'detail','category_id'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public static function getByCategory($category_id){
        return Brand::where('category_id', '=', $category_id)->get();
    }

}
