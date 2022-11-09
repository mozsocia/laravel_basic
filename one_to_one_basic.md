customers table <br>
![image](https://user-images.githubusercontent.com/12442613/200936141-6d3257a7-3ab0-4405-9703-52769e62431d.png)


```php
 Schema::create('customers', function (Blueprint $table) {
            $table->id('cid');
            $table->string('name');
            $table->timestamps();
        });
```


<br><br>

profiles table <br>
![image](https://user-images.githubusercontent.com/12442613/200936194-ed8a9d38-f0be-4a69-bc7b-d69c4be5bce9.png)


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

