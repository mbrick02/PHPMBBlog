<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="/css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
          label {
            top: -25% !important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1><?= $headline ?></h1>
            <?= $validation_helper->display_errors(); ?>
            <p>
                <a href="/members" class="waves-effect waves-light btn">Previous Page</a>
            </p>

            <div class="row">
                <form class="col s12" action="/submit_member" method="post">
                  <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Enter first name" name="first_name" value="<?= $first_name ?>" id="first_name" type="text" class="validate">
                        <label for="first_name">First Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Enter last name" name="last_name" value="<?= $last_name ?>" id="last_name" type="text" class="validate">
                        <label for="last_name">Last Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Enter username" name="username" value="<?= $username ?>" id="username" type="text" class="validate">
                        <label for="username">Username</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Enter email address" name="email" value="<?= $email ?>" id="email" type="email" class="validate">
                        <label for="email">Email Address</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                      <textarea id="introduction" placeholder="Enter introduction here" name="introduction"class="materialize-textarea"><?= $introduction ?></textarea>
                      <label for="introduction">Introduction</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                      <select name="$country_id">
                        <option value="<?= $country_id ?>"><?= $selected_country_description ?></option>
                        <?php
                            foreach ($countries as $country_key => $country_value) {
                              echo '<option value="'.$country_key.'">'.$country_value.'</option>';
                            }
                         ?>
                      </select>
                      <label>Country</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Enter username" name="username" value="<?= $username ?>" id="username" type="text" class="validate">
                        <label for="username">username</label>
                    </div>
                </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="submit" value="Submit">Submit
                            <i class="material-icons right">send</i>
                            </button>

                            <?php
                            if (isset($update_id)) {
                                ?>
                                <button class="btn red darken-3 waves-effect waves-light" type="submit" name="submit" value="Delete">Delete
                                <i class="material-icons right">delete_forever</i>
                                </button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if (isset($update_id)) {
                        ?>
                        <input type="hidden" name="update_id" value="<?= $update_id ?>">
                    <?php
                    }
                    ?>
                </form>
            </div>

        </div>

        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems); // from Materialize may add?: , options
          });
        </script>
    </body>
</html>
