<?php
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder{

     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run(){
          DB::table('users')->insert([
              'firstName' =>'Otoman',
              'lastName'  =>'Nkomanya',
              'email' => 'otomang@hotmail.com',
              'role_id'=>1,
              'password' => Hash::make('test1')
          ]);
          DB::table('users')->insert([
              'firstName' =>'Amon',
              'lastName'  =>'Bagoye',
              'email' => 'bagoye@hotmail.com',
              'role_id'=>2,
              'password' => Hash::make('test1')
          ]);
          DB::table('users')->insert([
              'firstName' =>'Joshua',
              'lastName'  =>'Mwambene',
              'email' => 'mwambene@hotmail.com',
              'role_id'=>2,
              'password' => Hash::make('test1')
          ]);
          DB::table('users')->insert([
              'firstName' =>'Jash',
              'lastName'  =>'Kry',
              'email' => 'jashkry@hotmail.com',
              'role_id'=>2,
              'password' => Hash::make('test1')
          ]);
          DB::table('users')->insert([
              'firstName' =>'Azori',
              'lastName'  =>'Bhilangoye',
              'email' => 'bhilangoye@hotmail.com',
              'role_id'=>2,
              'password' => Hash::make('test1')
          ]);
          DB::table('users')->insert([
              'firstName' =>'Festo',
              'lastName'  =>'Godfrey',
              'email' => 'godfrey@hotmail.com',
              'role_id'=>2,
              'password' => Hash::make('test1')
          ]);
      }

}
