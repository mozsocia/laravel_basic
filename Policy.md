Give me a full example with CRUD controller

Sure, here's an example of how to use Laravel Gate and Policy to implement a CRUD controller for managing a `Post` model.

First, let's define the `Post` model:

```php
class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

```

We've defined a `Post` model with a `title`, `body`, and `user_id` field, and a `user` method that defines a many-to-one relationship with t


Please continue

Sure, sorry about that. Here's the rest of the example.

Next, let's define the `PostController`. We'll use Laravel's resourceful routing to create routes for all the CRUD operations:

```php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return response()->json([
            'data' => $posts->map(function ($post) {
                return [
                    'type' => 'posts',
                    'id' => $post->id,
                    'attributes' => $post,
                    'links' => [
                        'self' => route('posts.show', $post)
                    ]
                ];
            }),
            'links' => [
                'self' => route('posts.index')
            ]
        ]);
    }

    public function show(Post $post)
    {
        return response()->json([
            'data' => [
                'type' => 'posts',
                'id' => $post->id,
                'attributes' => $post,
                'links' => [
                    'self' => route('posts.show', $post)
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $post = auth()->user()->posts()->create($request->all());

        return response()->json([
            'data' => [
                'type' => 'posts',
                'id' => $post->id,
                'attributes' => $post,
                'links' => [
                    'self' => route('posts.show', $post)
                ]
            ]
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->all());

        return response()->json([
            'data' => [
                'type' => 'posts',
                'id' => $post->id,
                'attributes' => $post,
                'links' => [
                    'self' => route('posts.show', $post)
                ]
            ]
        ], Response::HTTP_OK);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

```
```php
    Route::name('post.')->prefix('posts')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/{post}', [PostController::class, 'show'])->name('show');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::put('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });
```

We've defined methods for each of the CRUD operations, and we've added authorization checks for creating, updating, and deleting posts using Laravel Gate and Policy. Note that we're using the `authorize` method to check if the user is authorized to perform a particular action.

Next, let's define the `PostPolicy`. We'll define methods for each of the actions we want to authorize:

```php
class PostPolicy
{
    public function create(User $user)
    {
        return true;
    }
    
    public function view(User $user, Post $post)
    {
        return true;
    }
    
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
    
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}

```

We've defined a `PostPolicy` with methods for `create`, `view`, `update`, and `delete`. The `create` and `view` methods always return true, because we want to allow anyone to create or view a post. The `update` and `delete` methods check if the authenticated user is the owner of the post.

Finally, we need to register the `PostPolicy` in the `AuthServiceProvider`:

```php
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}

```

That's it! We've created a CRUD controller for managing posts, and we've added authorization checks using Laravel Gate and Policy. I hope this helps!
