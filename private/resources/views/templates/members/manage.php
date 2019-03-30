<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

        <div class="container">
            <h1>Members</h1>
            <?= $flashdata_helper->flashdata() ?>
            <p>
                <a href="/create_member" class="waves-effect waves-light btn">Create New Member</a>
            </p>

            <table class="striped">
                    <tr>
                        <th>Username</th>
                        <th>Real Name</th>
                        <th>Email Address</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    //loop through the results
                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        $update_url = '/create_member/'.$row->id;
                    ?>
                    <tr>
                        <td><?= $row->username ?></td>
                        <td><?= $row->first_name ?> <?= $row->last_name ?></td>
                        <td><?= $row->email ?></td>
                        <td><?= $row->country ?></td>
                        <td><a href="<?= $update_url ?>" class="waves-effect waves-light btn-small">Update</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
        </div>


      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
