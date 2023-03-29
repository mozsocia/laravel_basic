
### laravel standard way


```

- app/
  - Http/
    - Controllers/
      - HomeController.php
  - Providers/
    - AppServiceProvider.php
- resources/
  - views/
    - back/
      - auth/
        - layouts/
          - app.blade.php
        - login.blade.php
        - register.blade.php
        - forgot-password.blade.php
        - reset-password.blade.php
        - partials/
          - auth-header.blade.php
          - auth-footer.blade.php
      - dashboard/
        - layouts/
          - app.blade.php
        - index.blade.php
        - profile.blade.php
        - settings.blade.php
        - product/
          - index.blade.php
          - create.blade.php
          - show.blade.php
          - edit.blade.php
        - partials/
          - dashboard-header.blade.php
          - dashboard-footer.blade.php
- routes/
  - web.php


```



### general way
```
- app/
  - Http/
    - Controllers/
      - HomeController.php
  - Providers/
    - AppServiceProvider.php
- resources/
  - views/
    - back/
      - auth/
        - layout.blade.php
        - login.blade.php
        - register.blade.php
        - forgot-password.blade.php
        - reset-password.blade.php
        - partials/
          - auth-header.blade.php
          - auth-footer.blade.php
      - dashboard/
        - layout.blade.php
        - index.blade.php
        - profile.blade.php
        - settings.blade.php
        - product/
          - index.blade.php
          - create.blade.php
          - show.blade.php
          - edit.blade.php
        - partials/
          - dashboard-header.blade.php
          - dashboard-footer.blade.php
- routes/
  - web.php
```

```
#!/bin/bash

# Create the auth directory and its files
mkdir -p auth/partials
touch auth/layout.blade.php
touch auth/login.blade.php
touch auth/register.blade.php
touch auth/forgot-password.blade.php
touch auth/reset-password.blade.php
touch auth/partials/auth-header.blade.php
touch auth/partials/auth-footer.blade.php

# Create the dashboard directory and its files
mkdir -p dashboard/product
mkdir -p dashboard/partials
touch dashboard/layout.blade.php
touch dashboard/index.blade.php
touch dashboard/profile.blade.php
touch dashboard/settings.blade.php
touch dashboard/product/index.blade.php
touch dashboard/product/create.blade.php
touch dashboard/product/show.blade.php
touch dashboard/product/edit.blade.php
touch dashboard/partials/dashboard-header.blade.php
touch dashboard/partials/dashboard-footer.blade.php
```



