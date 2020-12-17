<?php
// Opens a connection to a MySQL server.
$conn=mysqli_connect ("localhost", 'root', '','test');
if (!$conn) {
    die('Not connected : ' . mysqli_connect_error());
}

// Sets the active MySQL database.
/*$db_selected = mysqli_select_db($connection,'accounts');
if (!$db_selected) {
    die ('Can\'t use db : ' . mysqli_error($connection));
}*/