<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThemeConfig extends Model
{
    protected $fillable = ['first_color','second_color','third_color','fourth_color'];

    use SoftDeletes;
}
