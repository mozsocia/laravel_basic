use of faker and seeder 

https://www.youtube.com/watch?v=Y8crm7oULds

```php

use Fake\Factory as Faker

class CustomerSeeder extends Seeder {

  public function run() {
      $faker = Faker::create();

      $customer = new Customer;
      $customer—>user_name = $faker->name;
      $customer->email = $faker->email;
      $customer->gender = "M";
      $customer—>address = $faker->address;
      $customer->state = $faker->state;
      $customer->country 2 $faker->coun:ry;
      $customer—>dob = $faker->date;
      $customer—>password = $faker->password;
      $customer—>save();
  }
}


```
![image](https://user-images.githubusercontent.com/12442613/201581354-73b5c962-c3e9-4e5c-b124-aa5fec36e89a.png)


-------------------------
-------------------------
## Create faker data in other parts of laravel through dependency injection

web.php
```php

use Faker\Generator as Faker;

Route::get('/create', function (Faker $faker) {

   
    $prof = new Profile();
    $prof->country = $faker->country();

    $cus->profile()->save($prof);

    $prof = new Profile();
    $prof->country = $faker->country();

    $prof->customer()->associate($cus)->save();

    return $cus;
});
```









