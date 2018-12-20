<?php 

session_start();

$mysqli = new mysqli('localhost', 'user', 'pass', 'base') or die(mysqli_error($mysqli));

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name, location) VALUES('name', '$location')") or
                    die($mysqli->error);

                    $_SESSION['message'] = "Registro salvo!";
                    $_SESSION['msg_type'] = "Sucesso";

                    header("location: index.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Registro deletado!";
    $_SESSION['msg_type'] = "Perigo";

    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
}