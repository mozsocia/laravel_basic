customers table <br>
![image](https://user-images.githubusercontent.com/12442613/200942223-b97307b0-fe2c-4548-a2c5-051b1935661e.png)



```php
 Schema::create('customers', function (Blueprint $table) {
            $table->id('cid');
            $table->string('name');
            $table->timestamps();
        });
```


<br><br>

profiles table <br>
![image](https://user-images.githubusercontent.com/12442613/200942320-3d0abbe0-6ba3-4754-a5e0-adfcf90aea74.png)



```php

 Schema::create('profiles', function (Blueprint $table) {
            $table->id('pid');
            $table->string('country');
            $table->bigInteger('customer_id');
            $table->timestamps();
        });
```



<br><br>


Customer.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->hasOne(Profile::class, 'customer_id', 'cid');
    }
}

```

Profile.php
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'cid');
    }
}

```

------------------------
-----------------------

```php
Route::get('/customer', function () {
    $customers = Customer::with('profile')->get();
    return $customers;
});

Route::get('/profile', function () {
    $customers = Profile::with('customer')->get();
    return $customers;
});

```








```json
http://127.0.0.1:8000/customer
[
   {
      "cid":1,
      "name":"Jordy Leuschke",
      "created_at":"2022-11-09T21:07:27.000000Z",
      "updated_at":"2022-11-09T21:07:27.000000Z",
      "profile":{
         "pid":1,
         "country":"Vanuatu",
         "customer_id":1,
         "created_at":"2022-11-09T21:07:28.000000Z",
         "updated_at":"2022-11-09T21:07:28.000000Z"
      }
   },
   {
      "cid":2,
      "name":"Alexandria Schinner",
      "created_at":"2022-11-09T21:07:28.000000Z",
      "updated_at":"2022-11-09T21:07:28.000000Z",
      "profile":{
         "pid":2,
         "country":"Martinique",
         "customer_id":2,
         "created_at":"2022-11-09T21:07:28.000000Z",
         "updated_at":"2022-11-09T21:07:28.000000Z"
      }
   },
   {
      "cid":3,
      "name":"Mireille Upton",
      "created_at":"2022-11-09T21:07:28.000000Z",
      "updated_at":"2022-11-09T21:07:28.000000Z",
      "profile":{
         "pid":3,
         "country":"Gambia",
         "customer_id":3,
         "created_at":"2022-11-09T21:07:28.000000Z",
         "updated_at":"2022-11-09T21:07:28.000000Z"
      }
   }
]
```

```json
http://127.0.0.1:8000/profile
[
   {
      "pid":1,
      "country":"Vanuatu",
      "customer_id":1,
      "created_at":"2022-11-09T21:07:28.000000Z",
      "updated_at":"2022-11-09T21:07:28.000000Z",
      "customer":{
         "cid":1,
         "name":"Jordy Leuschke",
         "created_at":"2022-11-09T21:07:27.000000Z",
         "updated_at":"2022-11-09T21:07:27.000000Z"
      }
   },
   {
      "pid":2,
      "country":"Martinique",
      "customer_id":2,
      "created_at":"2022-11-09T21:07:28.000000Z",
      "updated_at":"2022-11-09T21:07:28.000000Z",
      "customer":{
         "cid":2,
         "name":"Alexandria Schinner",
         "created_at":"2022-11-09T21:07:28.000000Z",
         "updated_at":"2022-11-09T21:07:28.000000Z"
      }
   },
   {
      "pid":3,
      "country":"Gambia",
      "customer_id":3,
      "created_at":"2022-11-09T21:07:28.000000Z",
      "updated_at":"2022-11-09T21:07:28.000000Z",
      "customer":{
         "cid":3,
         "name":"Mireille Upton",
         "created_at":"2022-11-09T21:07:28.000000Z",
         "updated_at":"2022-11-09T21:07:28.000000Z"
      }
   }
]
```

```php
```



