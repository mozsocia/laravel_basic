

# Laravel image upload.

> ## Excerpt
> A conversational AI system that listens, learns, and challenges

---
Sure! Here is a step-by-step guide on how to upload an image in Laravel:

Step 1: Create a form to upload the image You can create a form with an input of type "file" that allows users to select an image to upload. Here's an example:

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

Note the `enctype="multipart/form-data"` attribute, which is necessary to upload files.

Step 2: Define a route for the form submission In your `web.php` routes file, define a route to handle the form submission:

```php
Route::post('/upload', [ImageController::class,'upload']);

```

This route will call the `upload` method of the `ImageController` when the form is submitted.

Step 3: Define the `upload` method in the controller Create a new controller called `ImageController` using the `php artisan make:controller ImageController` command. Then, define the `upload` method in the controller to handle the file upload:

```php
public function upload(Request $request)
{
  $image = $request->file('image');
  $imageName = time() . '.' .$image->getClientOriginalName();
  $image->move(public_path('uploads'), $imageName);

  return back()->with('success', 'Image uploaded successfully!');
}

```

This method first retrieves the uploaded file from the request using the `file` method. It then gets the original name of the file using the `getClientOriginalName` method. Finally, it moves the file to the `public/uploads` directory using the `move` method.
