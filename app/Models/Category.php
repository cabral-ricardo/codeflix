<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
#use Ramsey\Uuid\Uuid;
use App\Models\Traits;

class Category extends Model
{
    use SoftDeletes, Traits\Uuid;
    protected $fillable = ['name', 'description', 'is_active'];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
