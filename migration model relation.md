```php
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategory_id')
                ->on('sub_category')
                ->onDelete('cascade');
                
```

```php
        Schema::create('sub_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('subsubcategory_name_en');
            $table->string('subsubcategory_name_hin');
            $table->string('subsubcategory_slug_en');
            $table->string('subsubcategory_slug_hin'); 
            $table->timestamps();
        });
 ```
 
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
