#### https://youtu.be/UWniysfpTmM    ------- app_guard project video summary 

make model admin <br>
` php artisan make:model Admin -m ` <br>

copy all code from User.php and change class name and add <br> ` protected $guard = 'admin'; `

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'admin';
   
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}


```

create migration columns just like User migrations

```php
Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
```
<br><br>

change in config/auth.php <br>
here admin and admins is created by me

```php
<?php

return [

...
...

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],



    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],
...
...
...

];
```
<br><br>

web.php
```php

......

Route::namespace ('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace ('Auth')->middleware('guest:admin')->group(function () {
        Route::get('login', 'AuthenticatedSessionController@create')->name('login');
        Route::post('login', 'AuthenticatedSessionController@store')->name('adminlogin');

    });
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', 'HomeController@index')->name('dashboard');

    });
    Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');

});

```
<br><br>

add to App/Providers/RouteServiceProvider.php

```php
....
    public const ADMIN_HOME = '/admin/dashboard';

    protected $namespace = 'App\\Http\\Controllers';
....
```
<br><br>

App\Http\Requests\Auth\AdminLoginRequest.php

```php

<?php

namespace App\Http\Requests\Auth;

class AdminLoginRequest extends FormRequest
{
    ...
    ...
    ...

    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::guard('admin')->attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    ...
    ...
    ...
    
}
```

<br><br>
App\Http\Controllers\Admin\Auth\AuthenticatedSessionController.php

```php
<?php

namespace App\Http\Controllers\Admin\Auth;

class AuthenticatedSessionController extends Controller
{
   
    public function create()
    {
        return view('admin.auth.login');
    }

   
    public function store(AdminLoginRequest $request)
    {
        
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }


    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

```
<br><br>
App\Http\Controllers\Admin\HomeController.php

```php
<?php

namespace App\Http\Controllers\Admin;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }
}

```


### to see the view files go to app_guard folder 






