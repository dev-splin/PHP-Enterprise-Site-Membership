<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    const CREATED_AT = 'mem_create_dt';
    const UPDATED_AT = 'mem_update_dt';

    protected $table = 'member';

    protected $dates = [
        'mem_update_pw_dt',
        'mem_last_login_dt'
    ];
}
