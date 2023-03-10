
# Upload image in Laravel.

> ## Excerpt
> A conversational AI system that listens, learns, and challenges

---
Sure, here are the basic steps to upload an image in Laravel:

1.  Create a form in your view:

form.blade.php
```php
<form method="POST" action="/upload" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button type="submit">Upload</button>
</form>

```
```php
Route::view('/upload','form');
```

2.  Define the route in your `routes/web.php` file:

```php
Route::post('/upload', 'ImageController@store');

```

3.  Create a controller named `ImageController` with a `store` method:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)

        $path = $request->file('image')->store('images', 'public');

        // this also works
        $path = $request->file('image')->store('public/images'); 

        return back()->with('success', $path);
    }
}

```
perfect way to do it
```php
      $image = $request->file('image');
      $originalName = $image->getClientOriginalName();
      $path = $image->storeAs('public/images', time() . '.' .$originalName);
      $filename = basename($path);

      return back()->with('success', json_encode([$path,$filename]));
```



to see the upload folder in public directory
```php
php artisan storage:link
```

4.  In the `store` method, we first retrieve the uploaded file using `$request->file('image')`.
    
5.  We then call the `store` method on the file, passing in the destination directory. This will store the file in the specified directory and return the path to the file.
    
6.  Finally, we can return the path or do something else with it, such as saving it to a database.
    

That's it! You should now be able to upload an image and have it stored in the specified directory. Note that you may need to configure your file system settings in `config/filesystems.php` to specify where uploaded files should be stored.



How to save the image name in database??

To save the image name in the database, you can modify the `store` method in `ImageController` to save the file name along with any other data you want to store about the image. Here's an updated version of the `store` method:

```php
public function store(Request $request)
{
    $path = $request->file('image')->store('public/images');
    $filename = basename($path);
    $image = new Image;
    $image->name = $filename;
    $image->description = $request->input('description');
    $image->save();
    return redirect('/')->with('success', 'Image uploaded successfully.');
}

```

In this example, we're creating a new `Image` model and setting the `name` attribute to the file name. We're also setting the `description` attribute to a value that was submitted with the form. Finally, we're calling the `save` method to save the model to the database.

Note that this assumes you have an `Image` model already defined with a corresponding table in the database. If you don't have one already, you can create one by running the following command:

```php
php artisan make:model Image -m

```

This will create a new model file (`Image.php`) and a corresponding migration file, which you can modify to define the schema for the `images` table. Once you've defined the schema and run the migration (`php artisan migrate`), you should be able to save the image name to the database using the `store` method.

------------------
---------------------
---------------------


# Upload image in Laravel.

> ## Excerpt
> A conversational AI system that listens, learns, and challenges

---
Give me whole code for multiple image upload

Sure, here's an example code for multiple image upload in Laravel:

1.  Create a form in your view:

```blade
<form method="POST" action="/upload" enctype="multipart/form-data">
    @csrf
    <input type="file" name="images[]" multiple>
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Upload</button>
</form>

```

2.  Define the route in your `routes/web.php` file:

```php
Route::post('/upload', 'ImageController@store');

```

3.  Create a controller named `ImageController` with a `store` method:

```php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $images = $request->file('images');
        $description = $request->input('description');

        foreach($images as $image) {
            $path = $image->store('public/images');
            $filename = basename($path);
            $newImage = new Image;
            $newImage->name = $filename;
            $newImage->description = $description;
            $newImage->save();
        }

        return redirect('/')->with('success', 'Images uploaded successfully.');
    }
}

```

4.  In the `store` method, we first retrieve the uploaded files using `$request->file('images')`.
    
5.  We then loop through each file and store it in the specified directory, just like before.
    
6.  We create a new `Image` model for each file and set the `name` and `description` attributes.
    
7.  Finally, we call the `save` method to save the model to the database.
    

That's it! You should now be able to upload multiple images and have them stored in the specified directory with their names and descriptions saved in the database. Note that you may need to modify the `Image` model and migration file to include the `description` column.
