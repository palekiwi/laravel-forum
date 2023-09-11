<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTopic
 */
class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];
}
