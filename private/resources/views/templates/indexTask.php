<?php
// NOT using app\Models\Task as Task;
// NOT setup to be handled by initialize->autoload:
require_once('del_spcodecrsmdl_task.class.php');
// for below: in initialize.php as require_once('speedcodeclasses.php');
// require_once 'class/Mdl_tasks.php';  // MB Note 3/26/19: after month break, reminder - model of lesson 8 & 9 above
/* Use my Slim $db for queries for this SpeedCode Academy testing
$mdl_tasks = new Mdl_tasks;
$mysql_query = 'select * from tasks order by created_at desc';
$result = $mdl_tasks->query($mysql_query);

Use $db->run via PDOConnect: function run($sql, $args = NULL)
examp: WHERE calories < :calories AND colour = :colour');...
    $sth->execute(array(':calories' => $calories,...

    Note in mbblog task, fields: id, title, completed(T/F), created_at, updated_at
    INSERT INTO tasks (body, completed) VALUES ('first task for Speed Coding Course', False);
*/
// note for code below: <?= is short for: <?php echo
$mysql_query = 'select * from tasks order by created_at desc';

$mdlTask = new Mdl_tasks;
$result = $mdlTask->query($mysql_query);
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!-- link rel="stylesheet" media="all" href="xxxhttp://phpmbblog.org/css/public.css" / -->

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

      <div class ="container">
    <h1>Your Tasks</h1>
    <p>
      <a href="/create_task" class="waves-effect waves-light btn">
        <i class="material-icons left">cloud</i>Create New Task</a>
    </p>

    <table class="striped">
      <tr>
        <th>Task title</th>
        <th>Description</th>
        <th>Finished</th>
        <th>Action</th>
      </tr>
    <?php
        // loop through the results
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $update_url = 'create_task/'.$row->id;
            $date_created = date('js \of F Y', $row->created_at);

            if ($row->completed>0) {
              $finished = 'yes';
            } else {
                $finished = 'no';
            }
    ?>
          <tr>
            <td><?= $row->title ?></td>
            <td><?= $date_created ?></td>
            <td><?= $finished ?></td>
            <td><td><a href="<?= $update_url ?>" class="waves-effect waves-light btn-small">Update</a></td></td>
          </tr>
      <?php
        // end while
      }
      ?>

    </table>
      </div>

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
