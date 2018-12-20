<!doctype html>
<html>
    <head>
        <title>Tela de cadastro</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </head>
    <body>
    <?php require_once 'process.php' ; ?>
    
    <?php 
    
    if (isset($_GET['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
        </div>
        <?php endif ?>
    
    <div class="container">
    <?php
        $mysqli = new mysqli('localhost', 'user', 'pass', 'base') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result->fetch_assoc());
        ?>

       <div class="row align-items-center justify-content-center">  
            <table class="table">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Localização</th>
                <th colspan="2">Actions</th>
            </tr>
            </thead>

        <?php 

            while ($row = $result->fetch_assoc()): 
            ?>
            <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class="btn btn-info">Editar</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Deletar</a>

                    </td>
                    </tr>
                    <?php endwhile; ?>

            </table>
       </div>
        
        <?php

        function pre_r( array ...$array ): array {
            echo '<pre>';
            print_r($array);
            echo '<pres>';
        }

    ?>

        <div class="row align-items-center justify-content-center">  
            <form action="process.php" method="post">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="name" class="form-control" value="Descrição: ">
                </div>
                <div class="form-group">
                    <label>Localização</label>
                    <input type="text" name="location" class="form-control" value="Localização: ">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="save">Salvar</button>
                </div>
            </form>
        </div>   
        </div>   
    </body>