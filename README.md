# Flight Management System
### IT Department @ Caribbean Sky Tours

- ## Users and privileges with Laravel + MySQL
Implementation of different privileges of users in Laravel


- ## API implementation

This tutorial will show how to implement and configure the system to receive and respond to an API call from clients using tokenization.

### **Requirements**


| Software | Version |
| ------ | ------ |
| PHP | >= 7.1.0|
| Composer | >= 1.6.3 |
| MySQL| >= 5.7.21 |
| Visual Studio Code | >= 1.21.1 |

>This tutorial assumes that you are using Laravel 5.6.0 and that you have previous experience using Laravel and PHP.

### **Set up**
Create the models and the migrations, in this case we will create a **Product** model and migration.

Run this command in your shell that is in the current project folder:

```sh
$ php artisan make:model Product -m
```

>The -m option stands for migration and let us create the migration file for our Products model.

Go to your Product migration file, tipically located at _/database/migrations_ , in the form of _2018_03_20_create_products_table.php_ (the date in the name will vary), add these fields:

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
Finally go to /app/Product.php model file and add these attributes to the $fillable variable:

```php
protected $fillable = ['name', 'description', 'code', 'buyPrice', 'sellPrice'];
```

### **Seeding the Products table**

We will create a simple seeder file to fill the products table and retrieve the data later on:

```sh
$ php artisan make:seeder ProductsTableSeeder
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
$ php artisan db:seed --class=ProductsTableSeeder
```

### **Creating the controller for the API**

Now we will create our controller and the endpoints inside /routes/api.php, to access our API. 

First we will create the controller:

```sh
$ php artisan make:controller ProductController
```

Inside /app/Controllers/ProductController.php, copy:

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
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $req, Product $product)
    {
        $product->update($req->all());
        return response()->json($product, 200);
    }

    public function delete(Product $product)
    {
        $product->delete();
        return response()->json("Deleted",204);
    }
}


```

Now go to /routes/api.php and copy:

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