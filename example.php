<?php


require("bootstrap.php");

use Illuminate\Database\Capsule\Manager as Capsule;
/*
Capsule::table('users')->insert(array(
        array('name' => 'Hello',  'email' => 'hello@world.com', 'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT),),
        array('name' => 'Carlos',  'email' => 'anzhengchao@gmail.com', 'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT),),
        array('name' => 'Overtrue',  'email' => 'i@overtrue.me', 'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT),),
    ));

 
$user = User::Create([    'name' => "Ahmed Khan",    'email' => "ahmed.khan@lbs.com",    'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT), ]);

print_r($user->todo()->create([

   'todo' => "Working with Eloquent Without PHP",

   'category' => "eloquent",

   'description' => "Testing the work using eloquent without laravel"

   ]));
  
   */
  
$users = User::all();


foreach ($users as $user) {
  echo $user->name;
}

 $users = User::where('id', '>', 1)->get();

foreach ($users as $user) {
  echo $user->name;
}




