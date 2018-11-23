<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'MD.admin',
            'email'=>'admin@blog.com',
            'password'=>'$2y$10$krMvFfBHzcm.xStoNTYCr.MC1xsLyWE4FIU21Eei2ovQRV/1Hax0.',
            'role_id'=>'2',
            'confirmation_token'=>'null',
            'remember_token'=>'xhJvMD5zYlGM8VKgCokNd3n4C7hzPd9L1stoJhXAvSEapDvoKv0nHvnPeDs0',
            'avatar'=>'0'

        ]);
    }
}
