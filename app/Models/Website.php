<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'user_id', 'status'];


    public static $rules = [
        'name' => 'required|unique:websites',
        'url' => 'required|url|unique:websites',


    ];




    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
