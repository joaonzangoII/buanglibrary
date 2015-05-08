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
    $this->call('UserPermissionTableSeeder');
    $this->call('UserTypeTableSeeder');
    $this->call('PermissionTableSeeder');
    $this->call('UserTableSeeder');
    $this->call('BookCategoryTableSeeder');
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}

class UserTypeTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\UserType::truncate();
        
        \App\UserType::create( [
            'name' => 'super_admin' ,
        ] );
         \App\UserType::create( [
            'name' => 'admin' ,
        ] );

        \App\UserType::create( [
            'name' => 'student' ,
        ] );

        \App\UserType::create( [
            'name' => 'lecturer' ,
        ] );
    }
}

class UserPermissionTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\UserPermission::truncate();
    }
}
class PermissionTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\Permission::truncate();

         \App\Permission::create( [
            'name' => 'edit_book' ,
        ]);

        \App\Permission::create( [
            'name' => 'delete_book' ,
        ]);
        \App\Permission::create( [
            'name' => 'create_book' ,
        ]);
        \App\Permission::create( [
          'name' => 'book_a_book' ,
        ]); 
        \App\Permission::create( [
          'name' => 'create_admin' ,
        ]);
    }
}

class BookCategoryTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\BookCategory::truncate();

         \App\BookCategory::create( [
            'name' => 'DRAMA' ,
        ]);

        \App\BookCategory::create( [
            'name' => 'ENVIRONMENT' ,
        ]);

        \App\BookCategory::create( [
            'name' => 'POETRY' ,
        ]);
        \App\BookCategory::create( [
            'name' => 'SCIENCE AND TECHNOLOGY  ' ,
        ]);
        \App\BookCategory::create( [
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
          'user_number' => 'ADM00001' ,
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
            'user_number' => 'SPR00001' ,
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
            'user_number' => 'ST00001' ,
        ]);

        $user = \App\User::create( [
            'email' => 'joaonzango@gmail.comm' ,
            'password' => "dbs" ,
            'fname' => 'Julio' ,
            'lname' => 'Nzango' ,
            'fullname' => '' ,
            'address' => 'address' ,
            'user_type' => 'lecturer' ,
            'user_number' => 'LEC00001' ,
        ]);


        $user->makeEmployee('lecturer');
    }
}
