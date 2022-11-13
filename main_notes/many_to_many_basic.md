```
php artisan Post -mf
php artisan tag -mf

php artisan make:migration create_post_tag_table 

```

```php

class Post extends Model
{
    use HasFactory;

    public function tags()
    {
        // public function belongsToMany(
        //     $related,
        //     $table = null,
        //     $foreignPivotKey = null,
        //     $relatedPivotKey = null,
        //     $parentKey = null,
        //     $relatedKey = null,
        //     $relation = null
        // ) { }
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id', 'pid', 'tid');


    }

    protected $primaryKey = 'pid';
}

        Schema::create('posts', function (Blueprint $table) {
            $table->id('pid');
            $table->text('title');
            $table->timestamps();
        });





class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id', 'tid', 'pid');
    }

    protected $primaryKey = 'tid';
}

        Schema::create('tags', function (Blueprint $table) {
            $table->id('tid');
            $table->string('name');
            $table->timestamps();
        });

```


2022_11_12_171343_create_post_tag_table.php
```php
Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id');
            $table->bigInteger('tag_id');
            // $table->timestamps();

        });


```

factory.php
```php

class PostFactory extends Factory
{
    
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
        ];
    }
}

class TagFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}


class DatabaseSeeder extends Seeder
{
unction run()
    {
        // \App\Models\User::factory(10)->create();
        Post::factory(2)
            ->has(Tag::factory()->count(2))
            ->create();

        Tag::factory(2)
            ->has(Post::factory()->count(2))
            ->create();
    }
}

```

```
php artisan migrate:fresh --seed
```
web.php
```php
Route::get('/posts', function () {
    $data = Post::with('tags')->get();

    return $data;
});

Route::get('/tags', function () {
    $data = Tag::with('posts')->get();

    return $data;
});
```





