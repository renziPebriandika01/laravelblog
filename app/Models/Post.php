<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $with = ['category', 'user'];

    public function scopeSearch($query)
    {
        $query->where('title','like','%'.request('search').'%')
        ->orWhere('body','like','%'.request('search').'%')
        ->orWhere('slug','like','%'.request('search').'%')
        ->orWhere('excerpt','like','%'.request('search').'%');

      
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
   

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
