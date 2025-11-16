<?php

$mysqli = new mysqli('db', 'root', 'root', 'crud') or die(mysqli_error($mysqli));

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or die($mysqli->error);
}

if (isset($_GET['delete'])){
    $id = intval($_GET['delete']); // Convert to integer for security
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);
}