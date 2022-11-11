https://www.youtube.com/watch?v=7GUaH6BI_V0


make this command 
```

php artisan make:model Post -mf

php artisan make:event PostCreated

php artisan make:listener PostCreatedListener -e PostCreated

```

link event in model
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
    ];
}
    // migrations
 Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->timestamps();
        });


```

link between model and listener in EventServiceProvider
```php
namespace App\Providers;
class EventServiceProvider extends ServiceProvider
{
    .....
   protected $listen = [
        ......

        PostCreated::class => [
            PostCreatedListener::class,
        ],
    ];
    .....
}
```


event will get the post and store it in properties
```php
<?php

namespace App\Events;
.....

class PostCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    ....
}

```

listener will get the event, use any event proprerties and methods
```php
<?php

namespace App\Listeners;

use App\Events\PostCreated;

class PostCreatedListener
{
    
    public function __construct()
    {
        //
    }

    public function handle(PostCreated $event)
    {
        dd('From PostCreatedListener ', $event->post);
    }
}

```

web.php
```php
Route::get('/posts', function () {
    $data = Post::all();

    return $data;
});

Route::get('/post-create', function () {
    $data = Post::factory()->create();

    return [
        'created' => true,
        'data' => $data,
    ];

});

```

```php

