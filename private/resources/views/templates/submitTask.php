<?php
if (!isset($_POST)) {
    die('You should not be here.');
}

if ($submit == 'Submit') {
    // process the form
    $task_title = $_POST['task_title'];

    if (!isset($_POST['finished'])) {
    $finished = 0;
} else {
    $finished = 1;
}

    $date_created = time();


require_once 'class/Mdl_tasks.php';
$mdl_tasks = new Mdl_tasks;

if (isset($_POST['update_id'])) {
    // update the record [note: he got code from phpMyAdmin - record ->[Edit]
    $update_id = $_POST['update_id'];
    $mysql_query = "UPDATE `tasks` SET `task_title` = '$task_title', `finished` = $finished WHERE `id`= $update_id";
} else {
    // insert a new record
    $mysql_query = "
INSERT INTO  `tasks`
('task_title`, `date_created`, `finished`)
VALUES
('$task_title', $date_created, $finished)
";
}

$mdl_tasks->query($mysql_query); // do the query (insert or  update)

// redirect back toindex.php
header('location: index.php');
die();
}
