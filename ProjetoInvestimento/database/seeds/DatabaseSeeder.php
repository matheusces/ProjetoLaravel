<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //criando um usuário
        User::create([
            'cpf'           => '01234567866',
            'name'          => 'example',
            'phone'         => '1231231231',
            'birth'         => '2000-08-21',
            'gender'        => 'M',
            'email'         => 'example2@gmail.com',
            //criptografa ou não da senha antes de colocar no banco de dados
            'password'      => env('PASSWORD_HASH') ? bcrypt('123456') : '123456',
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
