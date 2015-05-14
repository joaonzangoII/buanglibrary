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
    $this->call('BooksTableSeeder');
    $this->call('BookingsTableSeeder');
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
            'name' => 'user' ,
        ] );
    }
}
class UserPermissionTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\UserPermission::truncate();
    }
}
class BookingsTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\Booking::truncate();
    }
}
class BookingUserTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\BookingUser::truncate();
    }
}
class PermissionTableSeeder extends Seeder {
   //bcrypt = Hash::Make
    public function run() {
        \App\Permission::truncate();
        \App\Permission::create( [
            'name' => 'create_user' ,
        ]);
        \App\Permission::create( [
            'name' => 'view_user' ,
        ]);
         \App\Permission::create( [
            'name' => 'edit_user' ,
        ]);
        \App\Permission::create( [
            'name' => 'delete_user' ,
        ]);
        \App\Permission::create( [
          'name' => 'book_a_book' ,
        ]); 
        \App\Permission::create( [
            'name' => 'create_book' ,
        ]);
        \App\Permission::create( [
            'name' => 'view_book' ,
        ]);
         \App\Permission::create( [
            'name' => 'edit_book' ,
        ]);
        \App\Permission::create( [
            'name' => 'delete_book' ,
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
    $faker = Faker\Factory::create();
    $user = \App\User::create( [
      'email' => 'dbs@tut.ac.za' ,
      'password' => "dbs" ,
      'fname' => 'DBS' ,
      'lname' => 'Subject' ,
      'id_number' => '8501016184086' ,
      'fullname' => '' ,
      'address' => $faker->address ,
      'user_type' => 'admin' ,
      'user_number' => 'ADM00001' ,
    ]);

    $user->addPermissions('admin');


    $user = \App\User::create( [
        'email' => 'jm@tut.ac.za' ,
        'password' => "dbs" ,
        'fname' => 'Jo' ,
        'lname' => 'DB' ,
        'id_number' => '8501016184086' ,
        'fullname' => '' ,
        'address' =>$faker->address ,
        'user_type' => 'super_admin' ,
        'user_number' => 'SPR00001' ,
    ]);

    $user->addPermissions('super_admin');

    $user = \App\User::create( [
        'email' => 'joaonzango@gmail.com' ,
        'password' => "dbs" ,
        'fname' => 'Joao' ,
        'lname' => 'Nzango' ,
        'id_number' => '8501016184086' ,
        'fullname' => '' ,
        'address' => $faker->address,
        'user_type' => 'user' ,
        'user_number' => 'ST00001' ,
    ]);

    $user->addPermissions('user');

    $user = \App\User::create( [
        'email' => 'joaonzangoii@hotmail.com' ,
        'password' => "dbs" ,
        'fname' => 'Julio' ,
        'lname' => 'Nzango' ,
        'id_number' => '8501016184086' ,
        'fullname' => '' ,
        'address' => $faker->address,
        'user_type' => 'user' ,
        'user_number' => 'LEC00001' ,
    ]);

    $user->addPermissions('user');
  }
}

  class BooksTableSeeder extends Seeder {
    //bcrypt = Hash::Make
    public function run() {
      \App\Book::truncate();
      \App\Cover::truncate();
      $user = \App\User::find(1);
      $categories = \App\BookCategory::all();
      $faker = Faker\Factory::create();
      $covers = ["1.jpeg","2.jpg","3.jpg","1.jpeg","2.jpg"];
      for ($i=0; $i < 5; $i++) { 
        $number = $faker->randomNumber(2);
        $cover = \App\Cover::create([
          "image" => $covers[$i],
          "alt" => "",
        ]);
        $book = \App\Book::create([
          "title" => $faker->text($maxNbChars = 50),
          "author" => $faker->name,
          "edition" => "1st",
          "isbn" => $faker->ean13,
          "total_num_books" => $number,
          "avail_books" => $number,
          "year"=> $faker->year($max = 'now') ,
          "price" => $faker->randomNumber(2),
          "user_id" =>  $user->id,
          "book_category_id" => $categories[$i]->id,
          "published_at" =>new DateTime(),
        ]); 

        $book->cover()->save($cover);      
      }

      for ($i=0; $i < 5; $i++) { 
        $number = $faker->randomNumber(2);
        $cover = \App\Cover::create([
          "image" => $covers[$i],
          "alt" => "",
        ]);
        $book = \App\Book::create([
          "title" => $faker->text($maxNbChars = 50),
          "author" => $faker->name,
          "edition" => "2nd",
          "isbn" => $faker->ean13,
          "total_num_books" => $number,
          "avail_books" => $number,
          "year"=> $faker->year($max = 'now') ,
          "price" => $faker->randomNumber(2),
          "user_id" =>  $user->id,
          "book_category_id" => $categories[$i]->id,
          "published_at" =>new DateTime(),
        ]); 

        $book->cover()->save($cover);      
      }

      for ($i=0; $i < 5; $i++) { 
        $number = $faker->randomNumber(2);
        $cover = \App\Cover::create([
          "image" => $covers[$i],
          "alt" => "",
        ]);
        $book = \App\Book::create([
          "title" => $faker->text($maxNbChars = 50),
          "author" => $faker->name,
          "edition" => "3rd",
          "isbn" => $faker->ean13,
          "total_num_books" => $number,
          "avail_books" => $number,
          "year"=> $faker->year($max = 'now') ,
          "price" => $faker->randomNumber(2),
          "user_id" =>  $user->id,
          "book_category_id" => $categories[$i]->id,
          "published_at" =>new DateTime(),
        ]); 

        $book->cover()->save($cover);      
      }


    }
  }
