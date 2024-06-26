<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comments extends Model
{
    use HasFactory;

    function commentable(): MorphTo
    {
        return $this->morphTo();
    }

}
