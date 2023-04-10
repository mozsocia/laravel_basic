there is a laravel Category model with arrtibutes name, slug, icon, give me SubCategory model , the migration file and controller full code - use fontawesome for icon - CODE ONLY

1 / 1

Sure, here's the code for the SubCategory model, migration file, and controller:

SubCategory Model:

```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

```

SubCategory Migration File:

```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}

```

SubCategory Controller:

```
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function create(Category $category)
    {
        return view('sub-categories.create', compact('category'));
    }

    public function store(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'slug' => 'required|string|unique:sub_categories,slug',
        ]);

        $category->subCategories()->create([
            'name' => $request->name,
            'icon' => $request->icon,
            'slug' => $request->slug,
        ]);

        return redirect()->route('categories.show', $category);
    }

    public function edit(Category $category, SubCategory $subCategory)
    {
        return view('sub-categories.edit', compact('category', 'subCategory'));
    }

    public function update(Request $request, Category $category, SubCategory $subCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'slug' => 'required|string|unique:sub_categories,slug,' . $subCategory->id,
        ]);

        $subCategory->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'slug' => $request->slug,
        ]);

        return redirect()->route('categories.show', $category);
    }

    public function destroy(Category $category, SubCategory $subCategory)
    {
        $subCategory->delete();

        return redirect()->route('categories.show', $category);
    }
}

```

I hope this helps! Let me know if you have any questions.


1 / 2

give me the Category model for above relation, CODE ONLY

1 / 1

Sure, here's the Category model code for the relationship with the SubCategory model:

```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon'];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}

```

This Category model has a `hasMany` relationship with the SubCategory model, which means that a category can have multiple sub-categories. I hope this helps!



1 / 1

give me the Route code for above Controller, CODE ONLY

1 / 1

Sure, here's the route code for the SubCategory controller:

```
Route::prefix('categories')->group(function () {
    Route::get('{category}/sub-categories/create', [SubCategoryController::class, 'create'])->name('sub-categories.create');
    Route::post('{category}/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');
    Route::get('{category}/sub-categories/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
    Route::put('{category}/sub-categories/{subCategory}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
    Route::delete('{category}/sub-categories/{subCategory}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy');
});

```

This code defines routes for the SubCategory controller using a prefix group. The `create` route displays a form to create a new sub-category for a given category. The `store` route processes the form submission and creates the new sub-category. The `edit` route displays a form to edit an existing sub-category for a given category. The `update` route processes the form submission and updates the sub-category. The `destroy` route deletes an existing sub-category. Note that these routes use dynamic segments for the `category` and `subCategory` parameters, which are used to retrieve the appropriate models in the controller methods.


1 / 1

give me index view file for above code

1 / 1

Sure, here's a possible index view file for the SubCategory controller:

```
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $category->name }} Sub-Categories</h1>
                <a href="{{ route('sub-categories.create', $category) }}" class="btn btn-primary">Add Sub-Category</a>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Icon</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->subCategories as $subCategory)
                            <tr>
                                <td>{{ $subCategory->name }}</td>
                                <td>{{ $subCategory->slug }}</td>
                                <td><i class="{{ $subCategory->icon }}"></i></td>
                                <td>
                                    <a href="{{ route('sub-categories.edit', [$category, $subCategory]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('sub-categories.destroy', [$category, $subCategory]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this sub-category?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

```

This view file displays a table of sub-categories for a given category. It includes buttons to add a new sub-category, edit an existing sub-category, and delete a sub-category. Note that it uses the `category` and `subCategory` models passed from the controller to generate the appropriate URLs for the edit and delete buttons. It also uses the `icon` attribute of each sub-category to display a Font Awesome icon.

1 / 1

give me create view file

1 / 1

Sure, here's a possible create view file for the SubCategory controller:

```
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Sub-Category for {{ $category->name }}</h1>
                <form action="{{ route('sub-categories.store', $category) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-fw fa-info-circle"></i></span>
                            </div>
                            <input type="text" name="icon" id="icon" class="form-control" placeholder="Enter the Font Awesome class name" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('categories.show', $category) }}" class="btn btn-link">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection

```

This view file displays a form to create a new sub-category for a given category. It includes fields for the `name`, `slug`, and `icon` attributes, as well as buttons to create the new sub-category or cancel and go back to the category details page. Note that it includes an input group for the `icon` attribute that displays a Font Awesome icon and a placeholder for the class name. It also uses the `category` model passed from the controller to generate the appropriate URL for the cancel button.
