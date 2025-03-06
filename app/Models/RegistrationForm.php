<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationForm extends Model
{
    use HasFactory;
    protected $table = 'registration_form';

    protected $fillable = [
        'name', 'name_bn', 'father_name', 'father_name_bn', 'mother_name', 'mother_name_bn', 'local_guardian_name', 'local_guardian_name_bn', 'relation_with_local_guardian', 'local_guardian_contact', 'guardian_yearly_income', 'self_mobile', 'father_mobile', 'mother_mobile', 'email','photo', 'present_vill',
        'present_post_office', 'present_post_code', 'present_district', 'present_thana', 'permanent_vill',
        'permanent_post_office', 'permanent_post_code', 'permanent_district', 'permanent_thana', 'es_4', 'es_5', 'es_6', 'es_7',
         'esif', 'quota', 'dob', 'brn','transaction_number',
        'gender', 'religion','user_id','approved','hsc_roll','hsc_section'
    ];

    public $timestamps = true;

    public function transaction(){
        return $this->hasOne(Transactions::class,'user_id','user_id');
    }

    public function ssc_info(){
        return $this->hasOneThrough(
            StudentsSscInfo::class,
            User::class,
            'id', 'mobile','user_id','email'
        );

    }
}
