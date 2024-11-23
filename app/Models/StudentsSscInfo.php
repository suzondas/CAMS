<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsSscInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'name_bn', 'board_name', 'roll', 'registration', 'gpa',
        'ssc_group','hsc_group', 'passing_year', 'session', 'esif_serial', 'quota_name',
        'mobile', 'gender', 'dob', 'email', 'address','registered'
    ];
}
