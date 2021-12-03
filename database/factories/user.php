<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\M_user;
use Faker\Generator as Faker;

$factory->define(M_user::class, function (Faker $faker) {
    return [
        //
        'tai_khoan'=>'admin',
        'mat_khau'=>md5('admin'),
        'email'=>'admin@gmail.com',
        'phan_quyen'=>0,
    ];
});
