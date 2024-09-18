<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // [
            //     'name' => 'employee',
            //     'email' => 'employee@gmail.com',
            //     'status' => '2',
            //     'password' => bcrypt('1234')
            // ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'status' => '1',
                'password' => bcrypt('1234')
            ],
            // [
            //     'name' => 'customer',
            //     'email' => 'customer@gmail.com',
            //     'status' => '0',
            //     'password' => bcrypt('1234')
            // ],
        ];
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        DB::table('status')->insert([
            ['status_name' => 'Pending'],
            ['status_name' => 'In Progress'],
            ['status_name' => 'Completed'],
        ]);
    }
}
