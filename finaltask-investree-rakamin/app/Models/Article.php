<?php

namespace App\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{


    // protected $table = 'articles';
    // protected $guarded = [];
    protected $table = 'article';
    protected $fillable = ['title', 'content', 'image', 'user_id', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }    

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }    
}
