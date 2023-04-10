```blade

   @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif



 <form class="text-center" action={{ route('posts.store') }} method="POST">

    <p class="h4 mb-4">Blog details</p>

    @csrf
    <input type="text" id="id_title" class="@error('title') is-invalid @enderror" placeholder="Title" name="title"
      value="{{ old('title') }}">
      @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror

    <input type="text" id="id_body" class="@error('title') is-invalid @enderror" placeholder="Body" name="body"
      value="{{ old('body') }}">
      
      @error('body')
           <div class="invalid-feedback">{{ $message }}</div>
      @enderror

    <button class="btn btn-purple btn-block" type="submit">Submit</button>

  </form>
      
 ```
 ```blade
    <form action="{{ route('sub_categories.store') }}" method="POST">
     @csrf
    
     <div class="form-group mb-4">
       <label for="name">Name</label>
       <input type="text" name="name" id="name" value="{{ old('name') }}"
         class="form-control @error('name') is-invalid @enderror">
       @error('name')
         <div class="invalid-feedback">{{ $message }}</div>
       @enderror
     </div>
     
      <div class="form-group mb-4">
       <label for="category_id">Category</label>
       <select name="category_id" id="category_id"
         class="form-control @error('category_id') is-invalid @enderror">
         <option value="">Select a category</option>
         @foreach ($categories as $category)
           <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
             {{ $category->name }}</option>
         @endforeach
       </select>
       @error('category_id')
         <div class="invalid-feedback">{{ $message }}</div>
       @enderror
     </div>
     
     <div class="form-group mb-4">
       <button type="submit" class="btn btn-primary">Create Sub-Category</button>
       <a href="{{ route('sub_categories.index') }}" class="btn btn-secondary">Cancel</a>
     </div>
   </form>
 ```
 ```blade
 
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    @if($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
    @endif
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    @if($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
    @endif
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    @if($errors->has('password'))
        <span class="error">{{ $errors->first('password') }}</span>
    @endif
    
    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>
    @if($errors->has('password_confirmation'))
        <span class="error">{{ $errors->first('password_confirmation') }}</span>
    @endif
    
    <button type="submit">Create user</button>
</form>

```
 
 
 
