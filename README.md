# laravel_breeze_setup

```
composer create-project laravel/laravel:8.* your-project-name 
```
```
composer require laravel/breeze:1.9.* --dev

php artisan breeze:install

```

add this to webpack.mix.js
```js
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

```

insure that you have this dependensies

```

"devDependencies": {
        "alpinejs": "^3.4.2",
        "axios": "^0.22.0",
        "bootstrap": "^5.1.3",
        "laravel-mix": "^6.0.6",
        "lodash": "^4.17.21",
        "postcss": "^8.3.9",
        "resolve-url-loader": "^3.1.4",
        "sass": "^1.42.1",
        "sass-loader": "^12.1.0"
    }
    
   ```
   
   
   ### ** *********copy resource folder **
   
   ```
   npm install
   npm run dev
   ```
   done


