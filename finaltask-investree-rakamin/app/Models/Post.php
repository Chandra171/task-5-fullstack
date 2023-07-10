<?php

namespace App\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
 use HasFactory;

    // protected $table = 'articles';
    protected $guarded = ['$id'];
    protected $table = 'article';
    protected $fillable = ['title', 'content', 'image', 'user_id', 'category_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }    
}
