

Sure! Here's an updated version of the JavaScript code that uses class selectors instead of an id selector for the session alert:

```php
@if (session('status'))
  <div class="alert alert-primary session-alert">
    {{ session('status') }}
  </div>
@endif

```

Next, create a CSS class for the floating alert:

```css
  .session-alert {
    display: none;
    position: fixed;
    top: 10px;
    right: 20px;
    z-index: 9999;
    opacity: .9;
  }

```

Notice that we added the `session-alert` class to the div. Now, we can select it using the class selector.

```js

    // Get all elements with the session-alert class
    const sessionAlerts = document.querySelectorAll('.session-alert');

    // Loop through all session alert elements
    sessionAlerts.forEach(sessionAlert => {
    
      sessionAlert.style.display = 'inline';

      // Add a transition effect to the alert
      sessionAlert.style.transition = 'transform 0.7s ease';

      // Slide the alert in from the right
      sessionAlert.style.transform = 'translateX(170%)';

      // Wait for 100ms to allow the slide-in effect to take place
      setTimeout(() => {
        // Slide the alert back to its original position
        sessionAlert.style.transform = 'translateX(0)';
      }, 100);

      // Wait for 5 seconds before sliding the alert out
      setTimeout(() => {
        // Slide the alert out to the right
        sessionAlert.style.transform = 'translateX(170%)';

        // Wait for 500ms to allow the slide-out effect to take place
        setTimeout(() => {
          // Remove the alert from the DOM
          sessionAlert.remove();
        }, 500);
      }, 5000);
    });
```

This code uses `document.querySelector('.session-alert')` to select the session alert element by its class name. The rest of the code is the same as before.
