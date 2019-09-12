<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizzes  extends Model
{
    public function questions() {
        $this->hasMany('App\Questions');
    }
}
