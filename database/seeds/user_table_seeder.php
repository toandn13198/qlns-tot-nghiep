<?php

use Illuminate\Database\Seeder;

class user_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\M_user::class,1)->create();

    }
}
