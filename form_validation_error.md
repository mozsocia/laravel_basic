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
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    <input type="text" id="id_body" class="@error('title') is-invalid @enderror" placeholder="Body" name="body"
      value="{{ old('body') }}">

    <button class="btn btn-purple btn-block" type="submit">Submit</button>

  </form>
      
 ```
 
 
 
