# Laravel image upload.

> ## Excerpt
> A conversational AI system that listens, learns, and challenges

---
Sure, here's a code sample for uploading multiple images with  saving them to the database:

First, create a form with inputs for the images:

form.blade.php
```php
<form method="POST" action="/upload" enctype="multipart/form-data">
  @csrf
  <div>
    <label for="images">Images:</label>
    <input type="file" name="images[]" multiple>
  </div>

  <button type="submit">Upload</button>
</form>

```

```php
Route::view('/upload','form');
```

Note that we're using arrays for the names and descriptions so that we can associate them with each image.

Next, define a route to handle the form submission:

```php
Route::post('/upload', [ImageController::class,'upload']);

```

Then, create a new controller called `ImageController` using the `php artisan make:controller ImageController` command, and define the `upload` method in the controller:

```php
public function upload(Request $request)
{
  $images = $request->file('images');

  foreach ($images as $key => $image) {
    $imageName = time() . '.' .$image->getClientOriginalName();
    $image->move(public_path('uploads'), $imageName);

    $data = array(
      'image' => $imageName
    );

    // write db model
    // Image::create($data);
  }

  return back()->with('success', 'Images uploaded successfully!');
}

```

This method first retrieves the uploaded files from the request using the `file` method. It then retrieves the names and descriptions using the `input` method.

Next, it loops through the uploaded images and saves them to the `public/uploads` directory with their original names using the `move` method. It then creates an array with the name, description, and image name and uses the `create` method of the `Image` model to save the data to the database.

Finally, it redirects back to the form with a success message.

Note that we're assuming here that you have an `Image` model with the `image` fields in your database. You can create this model and its corresponding migration using the `php artisan make:model Image -m` command.

That's it! With these steps, you should be able to upload multiple images with their names and descriptions and save them to the database.
