<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicData extends Model
{
    use HasFactory;

    protected $fillable = ['uuid, user_id,title, desc,status,due_date,done_date'];

    protected static function boot()
    {
        parent::boot();

        //
        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = Str::uuid();
            }
        });
    }
}
