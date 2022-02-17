<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Questions extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'options', 'score', 'is_true_option', 'active'
    ];

    protected $dates = ['deleted_at'];

}
