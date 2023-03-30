Sure! Here's an updated version of the JavaScript code that uses class selectors instead of an id selector for the session alert:

```blade


@if ($errors->any())

  <div class="alert alert-danger session-alert">
    {{ __('Whoops! Something went wrong.') }}
  </div>

  <div class="row d-fex justify-content-center mt-3">
    <div class="col-md-6 dip">
      <ul class="mt-3 list-group list-group-light text-danger">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>

@endif

```

Next, create a CSS class for the floating alert:

```css
.alert-floating {
  position: fixed;
  top: 10px;
  right: 10px;
  z-index: 9999;
}

```

Notice that we added the `session-alert` class to the div. Now, we can select it using the class selector.

```js

  // Get the session alert element
  const sessionAlert = document.querySelector('.session-alert');

  // Add the alert-floating class to make it float
  sessionAlert.classList.add('alert-floating');

  // Add a transition effect to the alert
  sessionAlert.style.transition = 'transform 0.5s ease';

  // Slide the alert in from the right
  sessionAlert.style.transform = 'translateX(100%)';

  // Wait for 100ms to allow the slide-in effect to take place
  setTimeout(() => {
    // Slide the alert back to its original position
    sessionAlert.style.transform = 'translateX(0)';
  }, 100);

  // Wait for 5 seconds before sliding the alert out
  setTimeout(() => {
    // Slide the alert out to the right
    sessionAlert.style.transform = 'translateX(100%)';

    // Wait for 500ms to allow the slide-out effect to take place
    setTimeout(() => {
      // Remove the alert from the DOM
      sessionAlert.remove();
    }, 500);
  }, 5000);


```

This code uses `document.querySelector('.session-alert')` to select the session alert element by its class name. The rest of the code is the same as before.
