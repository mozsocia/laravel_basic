# How to define model and migrations , creating data
https://github.com/piotr-jura-udemy/laravel-cheat-sheet/blob/master/docs/0036-one-to-one.md

#### model Author.php
```php
class Author extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}

// migration
 Schema::create(
            'authors', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('age');
                $table->timestamps();
            }
        );

```

#### model Profile.php
```php
class Profile extends Model
{
    use HasFactory;
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}

Schema::create(
            'profiles', function (Blueprint $table) {
                $table->id();
                $table->string('location');
                $table->timestamps();

                $table->unsignedBigInteger('author_id')->unique();
                $table->foreign('author_id')->references('id')->on('authors');
            }
        );
```

## Creating data

1.This is one way of creating relation model
       
```php
  $auth2 = new Author();
  $auth2->name = $faker->name();
  $auth2->age = $faker->randomDigit();
  $auth2->save();

  $pro1 = new Profile();
  $pro1->location = $faker->country();

  $auth2->profile()->save($pro1);
 ```
 
 2.This is Another way of creating relation model
 
 ```php
  $auth2 = new Author();
  $auth2->name = $faker->name();
  $auth2->age = $faker->numberBetween($min=15, $max= 50);
  $auth2->save();

  $pro1 = new Profile();
  $pro1->location = $faker->country();
  $pro1->author()->associate($auth2)->save();
        
```
-----------------------------
https://stackoverflow.com/questions/41509900/how-to-create-eloquent-model-with-relationship


```php

class Person extends Model
{
    protected $fillable = ['firstname', 'lastname'];

    public function employee()
    {
        return $this->hasOne('App\Employee');
    }
}


class Employee extends Model
{
    protected $fillable = ['position'];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
```


```php
$person = Person::create($personData);
$person->employee()->create($employeeData);
```
another way
```php
$person = Person::create(request()->all());
$person->employee()->create(request()->all());
```


        
        





