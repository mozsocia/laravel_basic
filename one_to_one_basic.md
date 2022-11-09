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

```php
```

```php
```

```php
```

```php
```


```php
```

```php
```

```php
```

