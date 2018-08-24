<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public $connection = 'mysql_bnb';

    public $timestamp = false;
}
