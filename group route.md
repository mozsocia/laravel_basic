#### prefix is for route end point:  `admin/users`, `admin/orders`

#### name for route name :  `admin.users.index` and `admin.orders.index` respectively.
```php
Route::name('admin.')->prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/orders', 'OrderController@index')->name('orders.index');
});


```
