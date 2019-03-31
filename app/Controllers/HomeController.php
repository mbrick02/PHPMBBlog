<?php
namespace app\Controllers;

use app\Models\User as User;

// If we use Twig Views: use Slim\Views\Twig as View;
//Gen named route URL: $url = $app->urlFor('products', array('arg1' => 'value')); // ?arg1=

class HomeController extends Controller
{
    // protected static $container;
  protected static function buildPage($contrVars = [])
  { // unused as of 11/14/18
    $contrVars = array_replace($contrVars, ['page_title' => 'Home',]);
      parent::buildPage($contrVars);
  }

    public function index($request, $response)
    {
        // IF USING TWIG: return static::$container->view->render($response, 'home.twig');

        global $db; // needed for DB/Model class instances

        $user = User::getInstance($db); // ***if user is logged-in NEED to get from sess

        $homeP = VIEWS_PATH . DS . 'templates' . DS . 'partials' . DS . 'home.php';

        $formVars = [ 'user' => $user];  // originally of signup, but ?use logged-in sess $user for profile

        $homePanel = static::$container->view->renderWithVariables($homeP, $formVars, false);

        // give vals to main.php template vars
        $optionvars = [];

        $optionvars['content'] = $homePanel;

        static::buildPage($optionvars);
    }

    public function testMB($param1='')
    { // route: /testMB
        $pageFile = TEMPLATE_PATH . DS . 'testMBCodePage.html';
        $formVars = [];
        $testPage = static::$container->view->
     renderWithVariables($pageFile, $formVars, false);

        return $testPage;
    }

    public function testPHP($param1='')
    { // route: /testMBPHP
        $pageFile = TEMPLATE_PATH . DS . 'testMBPHPPage.php';
        $formVars = [];
        $testPage = static::$container->view->
     renderWithVariables($pageFile, $formVars, false);

        return $testPage;
    }

    public function createTask($request, $response, $args)
    { // route: /create_task
        $pageFile = TEMPLATE_PATH . DS . 'testCreateTask.php';
        //debug - var_dump($args);
        //debug - die();

        $task_id = empty($args) ? '' : $args['id'];
        $formVars = ['task_id' => $task_id]; // added 3/27/19 to get id
        $testPage = static::$container->view->
     renderWithVariables($pageFile, $formVars, false);

        return $testPage;
    }

    public function indexTask()
    { // route: /indexTask
        $pageFile = TEMPLATE_PATH . DS . 'indexTask.php';
        $formVars = [];
        $testPage = static::$container->view->
     renderWithVariables($pageFile, $formVars, false);

        return $testPage;
    }

    public function submitTask($request, $response)
    { // route: /submit_task
        $pageFile = TEMPLATE_PATH . DS . 'submitTask.php';
        $formVars = [];
        $testPage = static::$container->view->
     renderWithVariables($pageFile, $formVars, false);

        return $testPage;
    }

    public function createMember($request, $response, $args)
    { // route: /create_member
        $pageFile = TEMPLATE_PATH . DS . 'create_member.php';
        $formVars = [];
        $member_id = empty($args) ? '' : $args['id'];
        $formVars = ['member_id' => $member_id];

        $testPage = static::$container->view->
   renderWithVariables($pageFile, $formVars, false);

        return $testPage;
    }
    public function members($request, $response)
    { // route: /members
        $pageFile = TEMPLATE_PATH . DS . 'members.php';
        $formVars = [];
        $testPage = static::$container->view->
   renderWithVariables($pageFile, $formVars, false);

        return $testPage;
    }
    public function membvwcreate($request, $response)
    { // route: /membvwcreate
        $pageFile = TEMPLATE_PATH . DS . 'members' . DS . 'create.php';
        $formVars = [];
        $testPage = static::$container->view->
   renderWithVariables($pageFile, $formVars, false);

        return $testPage;
    }
    public function membvwmanage($request, $response) { // route: /membvwmanage
        $pageFile = TEMPLATE_PATH . DS . 'members' . DS . 'manage.php';
        $formVars = [];
        $testPage = static::$container->view->
   renderWithVariables($pageFile, $formVars, false);

        return $testPage;
    }

    public function submit_member($request, $response) { // route: /submit_member
        $pageFile = TEMPLATE_PATH . DS . 'submit_member.php';
        $formVars = [];
        $testPage = static::$container->view->
   renderWithVariables($pageFile, $formVars, false);
        return $testPage;
    }

}
