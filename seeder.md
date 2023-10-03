You can create a seeder for the `Teacher` model in Laravel without using a factory by defining the data directly in the seeder class. Here's an example of how to create a `TeacherSeeder` with 5 sample records:

1. Create the seeder using the following command:

   ```bash
   php artisan make:seeder TeacherSeeder
   ```

   This command will generate a `TeacherSeeder.php` file in the `database/seeders` directory.

2. Open the `TeacherSeeder.php` file and define the data for your 5 teachers in the `run` method:

   ```php
   <?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\Teacher;

   class TeacherSeeder extends Seeder
   {
       public function run()
       {
           $teachers = [
               [
                   'name' => 'John Doe',
                   'designation' => 'Math Teacher',
                   'date_of_birth' => '1980-05-15',
                   'email' => 'john@example.com',
                   'joining_date' => '2020-01-15',
                   'username' => 'johndoe',
                   'password' => bcrypt('secret'),
               ],
               [
                   'name' => 'Jane Smith',
                   'designation' => 'Science Teacher',
                   'date_of_birth' => '1985-09-22',
                   'email' => 'jane@example.com',
                   'joining_date' => '2018-07-10',
                   'username' => 'janesmith',
                   'password' => bcrypt('password123'),
               ],
                // other data.....
             
           ];

           foreach ($teachers as $teacherData) {
               Teacher::create($teacherData);
           }
       }
   }
   ```

3. Run the seeder using the following command:

   ```bash
   php artisan db:seed --class=TeacherSeeder
   ```

    ```
    class DatabaseSeeder extends Seeder
    {
        public function run(): void
        {
            $this->call(TeacherSeeder::class);
        }
    }
    ```

This will populate the `teachers` table with 5 sample records using the data provided in the seeder.
