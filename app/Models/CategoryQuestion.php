<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryQuestion extends Model
{
    use HasFactory;
    protected $table = "categories_questions";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'question_id', 'required', 'class_related'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function question(){
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }
}
