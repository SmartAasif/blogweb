<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'description', 'slug', 'meta_title', 'meta_description', 'summary'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
