<?php

// get all products
$app->get('/api/products', function(){
  $products = DB::getInstance()->getAll("products");

  if(!$products->count()) {
  	echo 'No products';
  } else {
  	foreach($products->results() as $product) {
  	   echo $product->title, '<br>';
    }
  // $user->first()->username;
  }

  // DEBUG: echo json_encode($products->results()) . '<br />';

  echo "<br /> Thanks for looking at products!";
});

// GET by ID
$app->get('/api/products/{id}', function($request) {
	$id = $request->getAttribute('id');
  $products = DB::getInstance()->get("products", array('id', '=', $id));

  if(!$products) {
    echo "query failed";
  } else {

  if(!$products->count()) {
  	echo 'No products for id:' . $id;
  } else {  // we have at least (should be only 1) product
    $prodTitle = $products->first()->title;
    // DEBUG: header('Content-type: application/json');
    // DEBUG: echo json_encode($products->results()) . '<br />';
    echo "Info for: " . $prodTitle . '<br>';
  }

}
  echo "<br /> Thanks for looking at a product!";
});

// post data and create a new record in the db
$app->post('/api/products', function($request) {
  $my_name = $_POST['my_name'];
  echo "hello " . $my_name . "<br />";

  // ** Debug to list all keys and vals
  // foreach($_POST as $key=> $value) {
	//   echo "key {$key} was posted with a value of {$value}<br>";
  // }
// INSERT INTO products (`imagePath`, `title`, `description`, `price`) 
//    VALUES ('images/products/3PTshirtjpg', '3rd Party Tshirt', 'A T-shirt with a solution to corporate greed', 15.00);

});

// update a record in db
$app->put('/api/products/{id}', function($request) {
  $my_name = $_POST['my_name'];
  echo "hello " . $my_name . "<br />";

});
