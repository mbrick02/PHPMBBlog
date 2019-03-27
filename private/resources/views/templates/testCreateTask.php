<?php
if (isset($_GET['id'])) {
    $update_id = $_GET['id'];
    $headline = 'Update Task';

    // fetch task title from db
    require_once 'class/Mdl_tasks.php';
    $mdl_tasks = new MDl_tasks;
    $mysql_query = 'select * from tasks where id = '.$update_id;
    $result = $mdl_tasks->Query($mysql_query);
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $task_tile = $row->task_title;
        $finished = $row->finished;
}


} else {  // this is an insert
    $headline = 'Create New Task';
    $task_title = '';
    $finished = '';
}
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
      <h1><?= $headline ?></h1>
      <p>
        <a href="/testMB" class="waves-effect waves-light btn">
          <i class="material-icons left">cloud</i>Previous Page</a>
      </p>

      <div class="row">
   <form class="col s12" action="submit_task.php" method="post">
     <div class="row">
       <div class="input-field col s6">
         <input placeholder="Enter task title" name="task_title" id="task_title" type="text" class="validate">
         <label for="first_name">Task Title</label>
       </div>
       <div class="input-field col s6">
         <p>
           <label>
             <input type="checkbox" name="finished" value="1" />
             <span>Finished</span>
           </label>
         </p>
       </div>
     </div>
     <div class="row">
       <div class="input-field col s12">
         <button class="btn waves-effect waves-light" type="submit" name="submit" value="Submit">Submit
  <i class="material-icons right">send</i>
</button>
       </div>
     </div>
     <?php
       if (isset($update_id)) { ?>
       <input type="hidden" name="update_id" value="<?= $update_id ?>">
     <?php } ?>
   </form>
 </div>
    </div>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
