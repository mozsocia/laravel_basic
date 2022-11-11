
make this command 
```

php artisan make:model Post -mf

php artisan make:observer PostObserver --model=Post

```

define model and migrations
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


}
    // migrations
 Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->timestamps();
        });


```

define observer
```php
<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{

    public function created(Post $post)
    {
        dd('From obderver method ', $post);
    }


    public function updated(Post $post)
    {
        //
    }


    public function deleted(Post $post)
    {
        //
    }

    public function restored(Post $post)
    {
        //
    }

    public function forceDeleted(Post $post)
    {
        //
    }
}


```


link observer in EventServiceProvider
```php
...

    public function boot()
    {

        Post::observe(PostObserver::class);
    }
...

```

web.php
```php
Route::get('/post-create', function () {
    $data = Post::factory()->create();

    return [
        'created' => true,
        'data' => $data,
    ];

});
```


```php

```