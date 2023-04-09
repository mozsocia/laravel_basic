```blade
<td>
    <a href="{{ route('brands.edit', $brand) }}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-sm btn-danger" 
        onclick="return confirm('Are you sure you want to delete this brand?')">Delete</button>
    </form>
</td>
```

```blade
  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
              @csrf
  </form>


  <div>
    <p class="text-warning mt-2 text-gray-800">
      Your email address is unverified.

      <button form="send-verification" class="btn btn-outline-primary">
        Click here to re-send the verification email.
      </button>
    </p>
  </div>
```


```blade
  <form method="POST" action="{{ route('logout') }}">
    @csrf

    <a class="dropdown-item" href="{{ route('logout') }}"
      onclick="event.preventDefault();
                        this.closest('form').submit();">
      Log Out
    </a>
  </form>
```


