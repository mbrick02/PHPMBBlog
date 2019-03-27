<?php
//if (isset($_GET['id'])) {
if (isset($task_id) && (!$task_id == '')) {
    // $update_id = $request()->params('id');
    $update_id = $task_id;
    $headline = 'Update Task';

    // fetch task title from db
    require_once 'del_spcodecrsmdl_task.class.php';
    $mdl_tasks = new MDl_tasks;
    $mysql_query = 'select * from tasks where id = '.$update_id;
    $result = $mdl_tasks->Query($mysql_query);
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $task_title = $row->title;
        $descripton = $row->description;
        $finished = $row->completed;
    }
} else {  // this is an insert
    $headline = 'Create New Task';
    $task_title = '';
    $descripton = '';
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
        <a href="/indexSCATask" class="waves-effect waves-light btn">
          <i class="material-icons left">cloud</i>Previous Page</a>
      </p>

      <div class="row">
   <form class="col s12" action="/submit_task" method="post">
     <div class="row">
       <div class="input-field col s6">
         <input placeholder="Enter task title" name="title" value="<?= $task_title ?>" id="title" type="text" class="validate">
         <label for="title">Task Title</label>
       </div>
       <div class="input-field col s6">
         <input placeholder="Enter description" name="description" value="<?= $descripton ?>" id="description" type="text" class="validate">
         <label for="description">Description</label>
       </div>
       <div class="input-field col s6">
         <p>
           <label>
             <input type="checkbox" name="finished" value="1" <?php if ($finished == 1) { echo 'checked'; } ?>>
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
        <button class="btn red darken-3 waves-effect waves-light" type="submit" name="submit" value="Delete">Delete
         <i class="material-icons right">delete_forever</i>
        </button>
       </div>
     </div>
     <?php
       if (isset($update_id)) {
           ?>
       <input type="hidden" name="update_id" value="<?= $update_id ?>">
     <?php
       } ?>
   </form>
 </div>
    </div>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
