# Restful API server with Oauth2 (Laravel + Passport)

This tutorial will show how to implement and configure a restful API service to receive and respond to an API call using tokenization and the Oauth2.0 flow.

## Requirements

| Software           | Version   |
| ------------------ | --------- |
| PHP                | >= 7.1.0  |
| Composer           | >= 1.6.3  |
| MySQL              | >= 5.7.21 |
| NodeJS             | >= 8.11.1 |
| NPM                | >= 5.6.0  |
| Visual Studio Code | >= 1.21.1 |
| Postman            | >= 6.0.10 |

>This tutorial assumes that you are using Laravel 5.6.0 and that you have previous experience using Laravel and PHP.

## Set up

Create the models and the migrations, in this case we will create a **Product** model and migration.

Run this command in your shell that is in the current project folder:

```sh
php artisan make:model Product -m
```

>The -m option stands for migration and let us create the migration file for our Products model.

Go to your "Product" migration file, tipically located at _database/migrations_ , in the form of _2018_03_20_create_products_table.php_ (the date in the name will vary), and add these fields:

```PHP
public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('code')->nullable();
            $table->double('buyPrice')->nullable();
            $table->double('sellPrice')->nullable();
            });
    }
```

Finally go to app/Product.php model file and add these attributes to the $fillable variable:

```php
protected $fillable = ['name', 'description', 'code', 'buyPrice', 'sellPrice'];
```

## Seeding the Products table

We will create a simple seeder file to fill the products table and retrieve the data later on:

```sh
 php artisan make:seeder ProductsTableSeeder
```

Go to /database/seeds/ProductsTableSeeder.php and copy:

```php
<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // truncate to start from 0 everytime.
        Product::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++)
        {
            Product::create([
                'name' => $faker->word,
                'description' => $faker->text,
                'code' => $faker->md5,
                'buyPrice' => $faker->randomDigit,
                'sellPrice' => $faker->RandomDigit
            ]);
        }
    }
}
```

Run the command to seed:

```sh
php artisan db:seed --class=ProductsTableSeeder
```

## Creating the controller for the API

Now we will create our controller and the endpoints inside routes/api.php, to access our API.

First we will create the controller:

```sh
php artisan make:controller ProductController
```

Inside app/Http/Controllers/ProductController.php, copy:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /** Using the variable {product} in the API, is possible
     * to use implicit route
     * model binding which makes easier the query for a
     * specific product inside the controller
    */
    public function index()
    {
        return Product::all();
    }

    public function show(Product $product)/** The argument is the ID*/
    {
        return $product;
    }

    public function store(Request $req)
    {
        $product = Product::create($req->all());
        return response()->json($product, 201);
    }

    public function update(Request $req, Product $product)
    {
        $product->update($req->all());
        // $product->name = $request->input('name');
        // $product -> save();
        return response()->json($product, 200);
    }

    public function delete(Product $product)
    {
        $product->delete();

        $data = array(
            'message' => 'Deleted',
            'id' => $product->id
        );
        return response()->json($data,200);
    }
}
```

Now go to **routes/api.php** and copy:

```PHP
/** Using the variable {product}, is possible to use implicit route
 * model binding which makes easier the query for a
 * specific product ID inside the controller
*/
Route::get('products','ProductController@index');
Route::get('products/{product}','ProductController@show');
Route::post('products','ProductController@store');
Route::put('products/{product}','ProductController@update');
Route::delete('products/{product}','ProductController@delete');
```

To make a test you can use [postman](https://www.getpostman.com) or curl in your terminal. For curl in your terminal with python, use:

```sh
curl -X GET http://localhost:8001/api/products | python -m json.tool
```

## Sending 404 NOT FOUND, the right way

We will add a route to **routes/api.php** and we will add a new file to **resources/views/errors/404.blade.php**.

First we will add a new route with the suffix "fallback" in **routes/api.php** to make it default for any kind of request that is not found.

```php
// Default route when the page is not found
Route::fallback(function(){
    return response()->json(['message' => 'Resource not Found'], 404);
});
```

And now we will create a file in **resources/views/errors/404.blade.php** with this content:

```php
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Page not found</h1>
        </div>
    </div>
</div>
@endsection
```

## Passport

The first thing is to type in your Terminal:

```sh
composer require passport
```

Go to **config/app.php** and in the service providers section add this line:

```php
Laravel\Passport\PassportServiceProvider::class
```

Go back to your terminal and run:

```sh
php artisan migrate
```

In this way we will migrate tables that the passport provider needs.

Also run in terminal:

```sh
php artisan passport:install
```

to generate a key to create access tokens, this files will save automatically in the storage folder.

We need to modify **app/User.php**, adding these 2 lines:

```php
//At the top
use Laravel\Passport\HasApiTokens;

//This line will go inside the User class
use HasApiTokens, Notifiable;
```

Now go to **app/providers/AuthServideProviders.php**
and add:

```php
//At the top of the file
use Laravel\Passport\Passport;

//Inside the method boot add:
Passport::routes();
```

Go to **config/auth.php** and change the api driver from ***token*** to ***passport***.

>Test the app by registering a user in the web browser.

The next step is to create a token so that our users can register their own applications (usually called create a **client** or **oauth client**), for this step **Passport** has prebuilt components with ***vue.js***.

Go to your terminal and run:

```sh
php artisan vendor:publish --tag=passport-components
```

>Ensure that you have installed **NodeJS** and **NPM**

In your terminal run:

```sh
npm install
npm run dev
```

To install all the frontend components and required dependencies and to compile all the required files (for propduction we would use npm run production).

Go to **resources/assets/js/app.js** and copy the following to add the vue components to your UI.

```javascript
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);


Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);
```

Now go to **resources/views/home.blade.php** and copy:

```html
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <passport-clients></passport-clients>
                <passport-authorized-clients></passport-authorized-clients>
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
    </div>
</div>
@endsection
```

### **Creating a consumer client application**

We will recreate a thrid party client application that requiere access to our API and that is going to use the Oauth2.0 flow.

>The first recommendation is to see how the Oauth2.0 flow works so you should check this quick youtube video [OAuth 2.0: An Overview](https://www.youtube.com/watch?v=CPbvxxslDTU)

To create the third party client, the first thing is to install, inside the project folder, this dependencies:

```sh
npm install express node-rest-client --save-dev
```

In the root project folder (/) create a file called **client.js** and copy this NodeJS example server:

```javascript
const express = require('express');
const app = express();
const querystring = require('querystring');
const Client = require('node-rest-client').Client;

var client = new Client();
var port = process.env.port || 3000;

//Passport variables to change
const oauthId = 4;
const oauthRedirectUri = "http://localhost:3000/redirect";
const oauthClientSecret = "p4gzEzTxCETko7xzQUG7LyQIwk347mXt7qEeHWcF";

//  Laravel app route to authorize the Oauth app
const authUri = "http://localhost:8001/oauth/authorize";
const tokenUri= "http://localhost:8001/oauth/token";


app.get('/', (req,res)=>{
   const query = querystring.stringify({
      "client_id": oauthId,
      "redirect_uri": oauthRedirectUri,
      "response_type": "code",
      "scope" : ""
   });
   res.redirect(authUri + "?" + query);
});

app.get('/redirect', (req,res)=>{
    var args = {
        data: {
            grant_type : "authorization_code",
            client_id : oauthId ,
            client_secret : oauthClientSecret,
            redirect_uri : oauthRedirectUri,
            code : req.query.code
         },
        headers: { "Content-Type": "application/x-www-form-urlencoded" }
    };

    client.post(tokenUri, args, function (data, response) {
        // parsed response body as JS object
        console.log(data);
        res.json(data); // Respond of the GET expressjs method
    });
});

app.listen(port, function(){
   console.log('App listening on port: '+ port);
});
```

This all you need to set up your NodeJS server, you can run in your terminal:

```sh
node client.js
```

To make it work, open your preference browser, open developer tools console and got to the NodeJS homepage.

> i.e. <http://localhost:3000/>

With this you will see an **access_token** and a **refresh_tokens**, which gives access to the client application to the restful API. Also you can see in your laravel app, in the login page, a section where the app is registered; this section is called **Authorized clients**.

### **Creating a Personal Access token**

Sometimes our clients would not want to go through the whole oauth 2.0 flow, so with this method they can get a token just with their user credentials. Basically it creates an access token in the UI.

>You just need to go to your login home page and select "*Create new token*" in the **Personal access Token section**.

## Protect your API routes with auth middleware

Got to **routes/api.php** and modify it like this:

```php
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /** Using the variable {product}, is possible to use implicit route
     * model binding which makes easier the query for a
     * specific model inside the controller
    */
    Route::get('products','ProductController@index');
    Route::get('products/{product}','ProductController@show');
    Route::post('products','ProductController@store');
    Route::put('products/{product}','ProductController@update');
    Route::delete('products/{product}','ProductController@delete');
});
```

## Testing

Go to Postman and create a get request, in authorization select Bearer token, copy the token and in Headers, click on bulk edit and type the following: **Accept:application/json**.

>An example of a GET address is <http://localhost:8001/api/products>

## Useful Links

- [Implementing an Restful API with Laravel](https://www.toptal.com/laravel/restful-laravel-api-tutorial)
- [Laravel Passport in Laravel 5.3](https://laracasts.com/series/whats-new-in-laravel-5-3/episodes/13)