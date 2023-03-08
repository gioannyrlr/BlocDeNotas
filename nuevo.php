<?php

$resp = ''; 

if(isset($_POST['crear'])){
    if($_POST['crear'] == 'create'){
        if(isset($_POST['nombre'])){

            $name = $_POST['nombre'];
            $message = '';

            $my_dir = "archivos/$name";

            try{
                if(!is_dir($my_dir)) {
                    mkdir($my_dir);
                    header('Location: abrir.php?dir=' . $dir);
                }else{
                    $my_dir = substr($my_dir, 9);
                    $message = "El directorio " . $my_dir . " ya existe.";
                }
            }catch(Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
            }
        }else{
            $message = '';
        }
    }else{
        $message = '';
    }
}else{
    $message = '';
}

unset($_POST['crear']);
unset($_POST['nombre']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="assets/css/styles.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Icon -->
    <link rel="icon" href="./assets/img/notepad-icon.webp">

    <title>Bloc de notas</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="./assets/img/notepad-icon.webp" alt="Logo" width="25" height="24" style="margin-left: 12px; background-color: #2c2c2c !important;" class="d-inline-block align-text-top">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item px-4">
                        <a class="nav-link text-white" href="nuevo.php">Nuevo directorio...</a>
                    </li>
                    <li class="nav-item pe-4">
                        <a class="nav-link" href="abrir.php">Archivos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="container-crear">
            <form action="nuevo.php" method="post" class="form-crear">
                <p class="titulo-crear">Directorios</p>
                <input type="text" name="nombre" class="input-crear">
                <button type="submit" name="crear" value="create" class="button-crear"><i class="bi bi-check2"></i></button>
            </form>
            <br>
        </div>

        <div class="container-p">
            <p style="display: flex !important; justify-content: center !important;"><?php echo $message ?></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>