<?php

namespace App\Models\users;

use App\Models\admins\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function admins()
    {
        return $this->belongsTo(User::class,'id');
    }
    protected $fillable=[
        'name',
       ];
}
