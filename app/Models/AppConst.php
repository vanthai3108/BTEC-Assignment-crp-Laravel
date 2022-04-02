<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConst extends Model
{
    const ROLE_ADMIN = 1;
    const ROLE_TRAINER = 2;
    const ROLE_TRAINEE = 3;
    const PASS = 50;
    const ACTIVE = 1;
    const HE_SO = 1;
    const HE_SO_PRODUCT = 5;
}
