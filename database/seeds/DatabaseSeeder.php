<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    $this->call('UserRoleTableSeeder');
    $this->call('TypeTableSeeder');
    $this->call('RoleTableSeeder');
    $this->call('UserTableSeeder');
    $this->call('CategoryTableSeeder');
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}

class TypeTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\Type::truncate();
        
        \App\Type::create( [
            'name' => 'super_admin' ,
        ] );
         \App\Type::create( [
            'name' => 'admin' ,
        ] );

        \App\Type::create( [
            'name' => 'student' ,
        ] );

        \App\Type::create( [
            'name' => 'lecturer' ,
        ] );
    }
}

class UserRoleTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\UserRole::truncate();
    }
}
class RoleTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\Role::truncate();

         \App\Role::create( [
            'name' => 'edit_book' ,
        ]);

        \App\Role::create( [
            'name' => 'delete_book' ,
        ]);
        \App\Role::create( [
            'name' => 'create_book' ,
        ]);
        \App\Role::create( [
          'name' => 'book_a_book' ,
        ]); 
        \App\Role::create( [
          'name' => 'create_admin' ,
        ]);
    }
}

class CategoryTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\Category::truncate();

         \App\Category::create( [
            'name' => 'DRAMA' ,
        ]);

        \App\Category::create( [
            'name' => 'ENVIRONMENT' ,
        ]);

        \App\Category::create( [
            'name' => 'POETRY' ,
        ]);
        \App\Category::create( [
            'name' => 'SCIENCE AND TECHNOLOGY  ' ,
        ]);
        \App\Category::create( [
            'name' => 'TRAVEL AND CULTURE' ,
        ]);
    }
}


class UserTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\User::truncate();

				$user = \App\User::create( [
            'email' => 'dbs@tut.ac.za' ,
            'password' => "dbs" ,
            'fname' => 'DBS' ,
            'lname' => 'Subject' ,
            'fullname' => '' ,
            'address' => 'address' ,
            'user_type' => 'admin' ,
        ]);

				$user->makeEmployee('admin');


        $user = \App\User::create( [
            'email' => 'jm@tut.ac.za' ,
            'password' => "dbs" ,
            'fname' => 'Jo' ,
            'lname' => 'DB' ,
            'fullname' => '' ,
            'address' => 'address' ,
            'user_type' => 'super_admin' ,
        ]);

        $user->makeEmployee('super_admin');

        $user = \App\User::create( [
            'email' => 'joaonzango@gmail.com' ,
            'password' => "dbs" ,
            'fname' => 'Joao' ,
            'lname' => 'Nzango' ,
            'fullname' => '' ,
            'address' => 'address' ,
            'user_type' => 'student' ,
        ]);

        $user->makeEmployee('student');
    }
}
