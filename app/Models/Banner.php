<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Banner extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = ['title', 'image', 'link', 'is_active', 'position'];
}