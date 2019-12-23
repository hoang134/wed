<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class   UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = 'hoangtu';
        $user->password = bcrypt('hoangtu');
        $user->save();

        $user = new User();
        $user->username = 'thong';
        $user->password = bcrypt('Thong');
        $user->save();

        $user = new User();
        $user->username = 'giangvien';
        $user->password = bcrypt('giangvien');
        $user->save();

    }


}
