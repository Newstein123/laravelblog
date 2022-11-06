<?php

namespace App\Models;

use App\Models\User;
use App\Models\View;
use App\Models\Image;
use App\Models\Slider;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded =  [];

    public function images ()
    {
       return $this->morphMany(Image::class, 'imageable');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function views() {
        return $this->hasMany(View::class);
    }

   
}
