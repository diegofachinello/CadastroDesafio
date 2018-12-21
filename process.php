<?php 

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'data') or die(mysqli_error($mysqli));

$id = 0;
$name = '';
$update = '';
$location = '';

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name, location) VALUES('name', '$location')") or die($mysqli->error);

                    $_SESSION['message'] = "Registro salvo!";
                    $_SESSION['msg_type'] = "Sucesso";

                    header('location: index.php');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Registro deletado!";
    $_SESSION['msg_type'] = "Perigo";

    header('location: index.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

    if (count($result)>=1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name = '$name', location = '$location' WHERE id = $id") or die($mysqli->error());

                    $_SESSION['message'] = "Registro atualizado!";
                    $_SESSION['msg_type'] = "Sucesso";

                    header('location: index.php');
}