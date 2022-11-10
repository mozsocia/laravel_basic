https://www.youtube.com/watch?v=m0IsbkfONL4&list=PL1TrjkMQ8UbVyIT0cDX-54gN5tunWZvaI


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
        return $this->hasMany(Profile::class, 'customer_id', 'cid');
        
            // 'customer_id' --> profiles table a cusromer ar id (foreign key)
            // 'cid' --> ai table ar primary key
    }
    
    protected $primaryKey = 'cid';
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
        
            //'customer_id' -->  ai table a customer ar id (foreign key)
            //'cid' --> customers table ar primary key
    }
    
    protected $primaryKey = 'pid';
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



Route::get('/prac', function () {
    $customers = Customer::has('profile')->with('profile')->get();
    // only those customer data who have profile data

    $customers = Customer::doesntHave('profile')->with('profile')->get();
    // only those customer data who dont have profile data

    $customers = Customer::has('profile', '>=', 2)->with('profile')->get();
    // only those have 2 or more profile data

    $customers = Customer::whereHas('profile', function ($query) {
        $query->where('country', 'like', '%lanka%');
    })->with('profile')->get();

    // only those customer have "lanka" in its country

    return $customers;
});

```








```json
http://127.0.0.1:8000/customer
 
[
   {
      "cid":1,
      "name":"Prof. Octavia Ferry",
      "created_at":"2022-11-10T06:19:57.000000Z",
      "updated_at":"2022-11-10T06:19:57.000000Z",
      "profile":[
         {
            "pid":1,
            "country":"Holy See (Vatican City State)",
            "customer_id":1,
            "created_at":"2022-11-10T06:19:57.000000Z",
            "updated_at":"2022-11-10T06:19:57.000000Z"
         },
         {
            "pid":2,
            "country":"Madagascar",
            "customer_id":1,
            "created_at":"2022-11-10T06:19:57.000000Z",
            "updated_at":"2022-11-10T06:19:57.000000Z"
         }
      ]
   },
   {
      "cid":2,
      "name":"Jordane Kihn",
      "created_at":"2022-11-10T06:19:57.000000Z",
      "updated_at":"2022-11-10T06:19:57.000000Z",
      "profile":[
         {
            "pid":3,
            "country":"Italy",
            "customer_id":2,
            "created_at":"2022-11-10T06:19:57.000000Z",
            "updated_at":"2022-11-10T06:19:57.000000Z"
         },
         {
            "pid":4,
            "country":"Paraguay",
            "customer_id":2,
            "created_at":"2022-11-10T06:19:57.000000Z",
            "updated_at":"2022-11-10T06:19:57.000000Z"
         }
      ]
   },
   {
      "cid":3,
      "name":"Jesse Schowalter",
      "created_at":"2022-11-10T06:19:57.000000Z",
      "updated_at":"2022-11-10T06:19:57.000000Z",
      "profile":[
         {
            "pid":5,
            "country":"Sri Lanka",
            "customer_id":3,
            "created_at":"2022-11-10T06:19:57.000000Z",
            "updated_at":"2022-11-10T06:19:57.000000Z"
         },
         {
            "pid":6,
            "country":"Anguilla",
            "customer_id":3,
            "created_at":"2022-11-10T06:19:58.000000Z",
            "updated_at":"2022-11-10T06:19:58.000000Z"
         }
      ]
   },
   {
      "cid":4,
      "name":"Connie Hayes",
      "created_at":"2022-11-10T06:22:46.000000Z",
      "updated_at":"2022-11-10T06:22:46.000000Z",
      "profile":[
         
      ]
   },
   {
      "cid":5,
      "name":"Samson D'Amore",
      "created_at":"2022-11-10T06:22:46.000000Z",
      "updated_at":"2022-11-10T06:22:46.000000Z",
      "profile":[
         
      ]
   }
]


```

```json
http://127.0.0.1:8000/profile
[
   {
      "pid":1,
      "country":"Holy See (Vatican City State)",
      "customer_id":1,
      "created_at":"2022-11-10T06:19:57.000000Z",
      "updated_at":"2022-11-10T06:19:57.000000Z",
      "customer":{
         "cid":1,
         "name":"Prof. Octavia Ferry",
         "created_at":"2022-11-10T06:19:57.000000Z",
         "updated_at":"2022-11-10T06:19:57.000000Z"
      }
   },
   {
      "pid":2,
      "country":"Madagascar",
      "customer_id":1,
      "created_at":"2022-11-10T06:19:57.000000Z",
      "updated_at":"2022-11-10T06:19:57.000000Z",
      "customer":{
         "cid":1,
         "name":"Prof. Octavia Ferry",
         "created_at":"2022-11-10T06:19:57.000000Z",
         "updated_at":"2022-11-10T06:19:57.000000Z"
      }
   },
   {
      "pid":3,
      "country":"Italy",
      "customer_id":2,
      "created_at":"2022-11-10T06:19:57.000000Z",
      "updated_at":"2022-11-10T06:19:57.000000Z",
      "customer":{
         "cid":2,
         "name":"Jordane Kihn",
         "created_at":"2022-11-10T06:19:57.000000Z",
         "updated_at":"2022-11-10T06:19:57.000000Z"
      }
   },
   {
      "pid":4,
      "country":"Paraguay",
      "customer_id":2,
      "created_at":"2022-11-10T06:19:57.000000Z",
      "updated_at":"2022-11-10T06:19:57.000000Z",
      "customer":{
         "cid":2,
         "name":"Jordane Kihn",
         "created_at":"2022-11-10T06:19:57.000000Z",
         "updated_at":"2022-11-10T06:19:57.000000Z"
      }
   },
   {
      "pid":5,
      "country":"Sri Lanka",
      "customer_id":3,
      "created_at":"2022-11-10T06:19:57.000000Z",
      "updated_at":"2022-11-10T06:19:57.000000Z",
      "customer":{
         "cid":3,
         "name":"Jesse Schowalter",
         "created_at":"2022-11-10T06:19:57.000000Z",
         "updated_at":"2022-11-10T06:19:57.000000Z"
      }
   },
   {
      "pid":6,
      "country":"Anguilla",
      "customer_id":3,
      "created_at":"2022-11-10T06:19:58.000000Z",
      "updated_at":"2022-11-10T06:19:58.000000Z",
      "customer":{
         "cid":3,
         "name":"Jesse Schowalter",
         "created_at":"2022-11-10T06:19:57.000000Z",
         "updated_at":"2022-11-10T06:19:57.000000Z"
      }
   }
]
```
---------------------------
---------------------------



```php
```
```php
```



