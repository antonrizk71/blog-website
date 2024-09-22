<?php

namespace App\Models\admins;

use App\Models\users\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];
    public function articles()
    {
        return $this->hasMany(Article::class,'id');
    }
}
