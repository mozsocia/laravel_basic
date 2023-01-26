# route model binding video

https://www.youtube.com/watch?v=6dEfxGLgevM



### chatgpt ans

In Laravel, route model binding allows you to automatically inject the model instance that corresponds to a given id in the route into your controller method.

To use route model binding, you first need to specify the type-hinted variable in your controller method that should receive the model instance. For example, if you have a User model and a route parameter of {user}, you would type-hint the User model in your controller method:

Copy code
```php
use App\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }
}
```
Then, you need to define the route parameter in the web routes file and bind the model to the parameter by its class name.

Copy code
```php
Route::get('users/{user}', 'UserController@show');
```
Finally, you need to register the bindings in the RouteServiceProvider.

Copy code
```php
public function boot()
{
    parent::boot();

    Route::model('user', User::class);
}
```php
With this configuration in place, when a user visits the /users/1 URL, Laravel will automatically retrieve the User model with an ID of 1 from the database and pass it to the show method on the UserController class.

You can also define custom keys in case your model's primary key is not 'id'

Copy code
```php
Route::model('user', User::class, function ($value) {
    return App\User::where('username', $value)->first();
});
```
It's important to note that If no matching model instance is found, Laravel will return a 404 Not Found response.