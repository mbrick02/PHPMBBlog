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
      <h1>Create New Task</h1>
      <p>
        <a href="/testMB" class="waves-effect waves-light btn">
          <i class="material-icons left">cloud</i>Previous Page</a>
      </p>

      <div class="row">
   <form class="col s12">
     <div class="row">
       <div class="input-field col s6">
         <input placeholder="Enter task title" id="task_title" type="text" class="validate">
         <label for="first_name">Task Title</label>
       </div>
       <div class="input-field col s6">
         <p>
           <label>
             <input type="checkbox" />
             <span>Finished</span>
           </label>
         </p>
       </div>
     </div>
     <div class="row">
       <div class="input-field col s12">
         <button class="btn waves-effect waves-light" type="submit" name="action">Submit
  <i class="material-icons right">send</i>
</button>
       </div>
     </div>
   </form>
 </div>
    </div>



      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
