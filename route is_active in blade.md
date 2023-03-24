how to detect product route in blade view and use active class in laravel app

To detect the current route in a Laravel Blade view and add an active class to the corresponding navigation link, you can use the `request()` function to get the current request object and compare it to the URL of the navigation link. Here's an example:

1.  Add a helper function in your `helpers.php` file (or anywhere else you prefer) to compare the current request URL to a given route:

```php
if (! function_exists('is_active')) {
    function is_active($route) {
        return request()->url() == route($route);
    }
}

```

2.  In your Blade view, add the `active` class to the navigation link if the current route matches the link's route:

```php
<ul>
    <li class="{{ is_active('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
    <li class="{{ is_active('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About Us</a></li>
    <li class="{{ is_active('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact Us</a></li>
</ul>

```

In the example above, the `is_active()` function compares the current request URL to the URL of each route ('home', 'about', 'contact'), and returns `true` if they match. If the function returns `true`, the `active` class is added to the corresponding navigation link.

Note: In this example, we're using named routes. If you're using route parameters or query strings in your routes, you may need to modify the `is_active()` function to handle them appropriately.


where is helpers.php??

In Laravel, the `helpers.php` file does not exist by default. It is a custom file that you can create and include in your project to define your own helper functions.

Here are the steps to create and include a `helpers.php` file in your Laravel project:

1.  Create a new file called `helpers.php` in your `app` directory (or any other directory of your choice).
    
2.  Define your helper functions in the `helpers.php` file. For example:
    

```php
if (!function_exists('my_helper_function')) {
    function my_helper_function() {
        // Your helper function code here
    }
}

```

3.  In your `composer.json` file, add the path to your `helpers.php` file to the `autoload` section, like this:

```php
"autoload": {
    "files": [
        "app/helpers.php"
    ],
    // ...
},

```

4.  Run the `composer dump-autoload` command in your terminal to generate the autoloader files.

After following these steps, your helper functions defined in `helpers.php` will be available in your entire Laravel application, and you can use them in any Blade view or PHP file.


how to detect a route have "product" in it, using this helper function

To detect if a route has "product" in it using the `is_active()` helper function, you can modify the function to accept a substring parameter that you want to check for in the route. Here's an example:

1.  Modify the `is_active()` function in your `helpers.php` file to accept a `$substring` parameter:

```php
if (! function_exists('is_active')) {
    function is_active($route, $substring) {
        return request()->url() == route($route) || str_contains(request()->url(), $substring);
    }
}

```

2.  In your Blade view, pass the `'product'` substring to the `is_active()` function as the second parameter when checking for the active class:

```blade
<ul>
    <li class="{{ is_active('home', 'product') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
    <li class="{{ is_active('about', 'product') ? 'active' : '' }}"><a href="{{ route('about') }}">About Us</a></li>
    <li class="{{ is_active('products.index', 'product') ? 'active' : '' }}"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="{{ is_active('contact', 'product') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact Us</a></li>
</ul>

```

In the example above, the `is_active()` function checks if the current URL matches the given `$route`, or if the `$substring` parameter is found in the URL. If either condition is true, the function returns `true` and the `active` class is added to the corresponding navigation link.

Note that in this example, we're assuming that the routes for products have `'product'` in their URL, such as `'/products'` or `'/products/123'`. If your routes have a different structure, you'll need to adjust the `$substring` parameter accordingly.


make $substring optional

To make the `$substring` parameter optional in the `is_active()` helper function, you can set a default value for the parameter. Here's how:

1.  Modify the `is_active()` function in your `helpers.php` file to set a default value for the `$substring` parameter:

```php
if (! function_exists('is_active')) {
    function is_active($route, $substring = null) {
        if (is_null($substring)) {
            return request()->url() == route($route);
        }
        return request()->url() == route($route) || str_contains(request()->url(), $substring);
    }
}

```

2.  In your Blade view, you can now omit the `$substring` parameter when calling the `is_active()` function if you don't need to check for a specific substring:

```blade
<ul>
    <li class="{{ is_active('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
    <li class="{{ is_active('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About Us</a></li>
    <li class="{{ is_active('products.index', 'product') ? 'active' : '' }}"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="{{ is_active('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact Us</a></li>
</ul>

```

In the example above, the `is_active()` function checks if the `$substring` parameter is `null`. If it is, it only checks if the current URL matches the given `$route`. If the `$substring` parameter is not `null`, it also checks if the `$substring` is found in the URL.

Note that if you omit the `$substring` parameter, the function will still work as expected, but it will be slightly less efficient since it will always call `str_contains()`, even if it's not necessary. However, the performance impact of this should be negligible for most applications.
