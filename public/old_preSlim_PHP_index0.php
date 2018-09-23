<?php error_reporting( E_ALL );
ini_set( "display_errors", 1 );
// require_once( "sample.php" );
// err not in php.ini for linux DEL above for Win ?>
<?php require_once('../private/initialize.php'); ?>
<?php
// Slim framework
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();
?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <ul id="menu">
    <li><a href="<?php echo url_for('/0000listing.php'); ?>">View Our Inventory</a></li>
    <li><a href="<?php echo url_for('/0000about.php'); ?>">About Us</a></li>
  </ul>

</div>

<!-- ?php $super_hero_image = '0000000000000.jpeg'; ? -->

<!-- ?php include(SHARED_PATH . '/public_footer.php'); ? -->
