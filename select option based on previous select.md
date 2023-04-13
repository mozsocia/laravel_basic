```blade

@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <h2>Create Sub-Sub-Category</h2>
    </div>
  </div>
  <form action="{{ route('subsubcategories.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="category_id">Category</label>
      <select class="form-control" id="category_id" name="category_id">
        <option value="">-- Select Category --</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
      @error('category_id')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="subcategory_id">Sub-Category</label>
      <select class="form-control" id="subcategory_id" name="subcategory_id">
        <option value="">-- Select Sub-Category --</option>
        @foreach ($subcategories as $subcategory)
          <option value="{{ $subcategory->id }}" data-category="{{ $subcategory->category_id }}">
            {{ $subcategory->name }}
          </option>
        @endforeach
      </select>
      @error('subcategory_id')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
      @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>


  <script>
    // Get references to the select elements
    const categorySelect = document.querySelector('#category_id');
    const subcategorySelect = document.querySelector('#subcategory_id');

    Array.from(subcategorySelect.options).forEach((option) => {
      option.style.display = 'none';
    });
    // Add an event listener to the category select element
    categorySelect.addEventListener('change', (event) => {
      const selectedCategoryId = event.target.value;

      // If no category is selected, show all subcategories
      if (!selectedCategoryId) {
        Array.from(subcategorySelect.options).forEach((option) => {
          option.style.display = 'block';
        });
        return;
      }

      // Otherwise, hide subcategories that don't belong to the selected category
      Array.from(subcategorySelect.options).forEach((option) => {
        const category = option.dataset.category;
        if (category !== selectedCategoryId) {
          option.style.display = 'none';
        } else {
          option.style.display = 'block';
        }
      });

      // Reset the subcategory select element to the default option
      subcategorySelect.value = '';
    });
  </script>
@endsection
