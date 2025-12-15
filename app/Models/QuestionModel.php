<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'name', 'surname', 'email', 'message'
    ];
}
