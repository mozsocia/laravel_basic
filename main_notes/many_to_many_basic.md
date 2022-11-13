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


posts table
![image](https://user-images.githubusercontent.com/12442613/201504462-57f3e55b-58c6-4f2b-92bb-5d4321b8d0a4.png)

tags table
![image](https://user-images.githubusercontent.com/12442613/201504446-46514a31-6bea-4ae9-aa78-89a34b79915d.png)

post_tag table
![image](https://user-images.githubusercontent.com/12442613/201504514-9856cf77-bbdf-4fd5-ab0f-c2c87fc1e825.png)


```json
http://127.0.0.1:8000/posts
[
   {
      "pid":1,
      "title":"dolor",
      "created_at":"2022-11-13T03:31:29.000000Z",
      "updated_at":"2022-11-13T03:31:29.000000Z",
      "tags":[
         {
            "tid":1,
            "name":"Jayda Collins",
            "created_at":"2022-11-13T03:31:29.000000Z",
            "updated_at":"2022-11-13T03:31:29.000000Z",
            "pivot":{
               "post_id":1,
               "tag_id":1
            }
         },
         {
            "tid":2,
            "name":"Dr. Buddy Beatty",
            "created_at":"2022-11-13T03:31:29.000000Z",
            "updated_at":"2022-11-13T03:31:29.000000Z",
            "pivot":{
               "post_id":1,
               "tag_id":2
            }
         }
      ]
   },
   {
      "pid":2,
      "title":"laudantium",
      "created_at":"2022-11-13T03:31:29.000000Z",
      "updated_at":"2022-11-13T03:31:29.000000Z",
      "tags":[
         {
            "tid":3,
            "name":"Ellie Lubowitz",
            "created_at":"2022-11-13T03:31:29.000000Z",
            "updated_at":"2022-11-13T03:31:29.000000Z",
            "pivot":{
               "post_id":2,
               "tag_id":3
            }
         },
         {
            "tid":4,
            "name":"Kamren Stracke",
            "created_at":"2022-11-13T03:31:30.000000Z",
            "updated_at":"2022-11-13T03:31:30.000000Z",
            "pivot":{
               "post_id":2,
               "tag_id":4
            }
         }
      ]
   },
   {
      "pid":3,
      "title":"eaque",
      "created_at":"2022-11-13T03:31:30.000000Z",
      "updated_at":"2022-11-13T03:31:30.000000Z",
      "tags":[
         {
            "tid":5,
            "name":"Clint Hessel",
            "created_at":"2022-11-13T03:31:30.000000Z",
            "updated_at":"2022-11-13T03:31:30.000000Z",
            "pivot":{
               "post_id":3,
               "tag_id":5
            }
         }
      ]
   },
   {
      "pid":4,
      "title":"eius",
      "created_at":"2022-11-13T03:31:30.000000Z",
      "updated_at":"2022-11-13T03:31:30.000000Z",
      "tags":[
         {
            "tid":5,
            "name":"Clint Hessel",
            "created_at":"2022-11-13T03:31:30.000000Z",
            "updated_at":"2022-11-13T03:31:30.000000Z",
            "pivot":{
               "post_id":4,
               "tag_id":5
            }
         }
      ]
   },
   {
      "pid":5,
      "title":"ad",
      "created_at":"2022-11-13T03:31:30.000000Z",
      "updated_at":"2022-11-13T03:31:30.000000Z",
      "tags":[
         {
            "tid":6,
            "name":"Prof. Geovanni Ondricka",
            "created_at":"2022-11-13T03:31:30.000000Z",
            "updated_at":"2022-11-13T03:31:30.000000Z",
            "pivot":{
               "post_id":5,
               "tag_id":6
            }
         }
      ]
   },
   {
      "pid":6,
      "title":"nemo",
      "created_at":"2022-11-13T03:31:31.000000Z",
      "updated_at":"2022-11-13T03:31:31.000000Z",
      "tags":[
         {
            "tid":6,
            "name":"Prof. Geovanni Ondricka",
            "created_at":"2022-11-13T03:31:30.000000Z",
            "updated_at":"2022-11-13T03:31:30.000000Z",
            "pivot":{
               "post_id":6,
               "tag_id":6
            }
         }
      ]
   }
]
```


