<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP Test MB</title>
  <style>
    nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    position: relative;
    float: right;
    background: #eee;
    border-bottom: 1px solid #fff;
    border-radius: 3px;
    }

    nav li {
    float: left;
    }

    nav #login {
    border-right: 1px solid #ddd;
    box-shadow: 1px 0 0 #fff;
    }

    nav #login-trigger,
    nav #signup a {
    display: inline-block;
    *display: inline;
    *zoom: 1;
    height: 25px;
    line-height: 25px;
    font-weight: bold;
    padding: 0 8px;
    text-decoration: none;
    color: #444;
    text-shadow: 0 1px 0 #fff;
    }

    nav #signup a {
    border-radius: 0 3px 3px 0;
    }

    nav #login-trigger {
    border-radius: 3px 0 0 3px;
    }

    nav #login-trigger:hover,
    nav #login .active,
    nav #signup a:hover {
    background: #ffd;
    }

    nav #login-content {
    display: none;
    position: absolute;
    top: 24px;
    right: 0;
    z-index: 999;
    background: #fff;
    background-image: linear-gradient(top, #fff, #eee);
    padding: 15px;
    box-shadow: 0 2px 2px -1px rgba(0,0,0,.9);
    border-radius: 3px 0 3px 3px;
    }

    nav li #login-content {
    right: 0;
    width: 250px;
    }

    /*--------------------*/

    #inputs input {
    background: #f1f1f1;
    padding: 6px 5px;
    margin: 0 0 5px 0;
    width: 238px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-shadow: 0 1px 1px #ccc inset;
    }

    #inputs input:focus {
    background-color: #fff;
    border-color: #e8c291;
    outline: none;
    box-shadow: 0 0 0 1px #e8c291 inset;
    }

    /*--------------------*/

    #login #actions {
    margin: 10px 0 0 0;
    }

    #login #submit {
    background-color: #d14545;
    background-image: linear-gradient(top, #e97171, #d14545);
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    text-shadow: 0 1px 0 rgba(0,0,0,.5);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
    border: 1px solid #7e1515;
    float: left;
    height: 30px;
    padding: 0;
    width: 100px;
    cursor: pointer;
    font: bold 14px Arial, Helvetica;
    color: #fff;
    }

    #login #submit:hover,
    #login #submit:focus {
    background-color: #e97171;
    background-image: linear-gradient(top, #d14545, #e97171);
    }

    #login #submit:active {
    outline: none;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
    }

    #login #submit::-moz-focus-inner {
    border: none;
    }

    #login label {
    float: right;
    line-height: 30px;
    }

    #login label input {
    position: relative;
    top: 2px;
    right: 2px;
    }
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" media="all" href="stylesheets/public.css" />



  <script>
  $(document).ready(function(){
  $('#login-trigger').click(function(){
      $(this).next('#login-content').slideToggle();
      $(this).toggleClass('active');

      if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
        else $(this).find('span').html('&#x25BC;')
      })
  });
  </script>

</head>
<body>
  <?php
  echo 'hullo world! <br /><br />';
   ?>
   <nav>
  <ul>
    <li id="login">
      <a id="login-trigger" href="#" class="btn btn-secondary dropdown-toggle" type="button"
			data-toggle="login-content" aria-haspopup="true" aria-expanded="false">
        Log in <span>▼</span>
      </a>
      <div id="login-content">
        <form>
          <fieldset id="inputs">
            <input id="username" type="email" name="Email" placeholder="Your email address" required>
            <input id="password" type="password" name="Password" placeholder="Password" required>
          </fieldset>
          <fieldset id="actions">
            <input type="submit" id="submit" value="Log in">
            <label><input type="checkbox" checked="checked">Keep me signed in</label>
          </fieldset>
        </form>
      </div>
    </li>
    <li id="signup">
      <a href="">Sign up FREE</a>
    </li>
  </ul>
</nav>

</body>
</html>
