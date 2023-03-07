<?php

    if(isset($_GET['dir']) && isset($_GET['note'])){
        $dir = $_GET['dir'];
        $note = $_GET['note'];
    }else{
        header("Location: nuevo.php");
    }

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
            <img src="./assets/img/notepad-icon.webp" alt="Logo" width="25" height="24" style="margin-left: 12px; background-color: #2c2c2c !important;" class="d-inline-block align-text-top" href="index.php">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item px-4">
                        <a class="nav-link" href="nuevo.php">Nuevo directorio...</a>
                    </li>
                    <li class="nav-item pe-4">
                        <a class="nav-link text-white" href="abrir.php">Archivos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php 

        try{
            $file = "archivos\\" . $dir . "\\" . $note;
            $size = filesize($file);
            if($size > 0){
                $contents = file_get_contents($file, FILE_USE_INCLUDE_PATH);
            }else{
                $contents = '';
            }

        }catch(Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
            $contents = "";
        }

    ?>

    <div class="container">
        <div class="container-url">
            <p>
                <a href="abrir.php" style="text-decoration: none;">
                    <img src="./assets/img/folder-icon.png" alt="Logo" width="25" height="24" style="margin: 0px 2px 0px 2px; background-color: transparent !important;" class="d-inline-block align-text-top">
                </a>
                > <a href="nuevo.php">Directorios</a> 
                > <a href="directorio.php?dir=<?php echo $dir ?>"><?php echo $dir ?></a>
                > <?php echo substr($note ,0 , (strlen($note) - 5)); ?>
            </p>
        </div>
        <br><br>
        <form action="guardar.php" method="post" name="save">
            <p style="text-align: center; ">Toca para editar</p>
            <textarea name="textarea-nota" class="textarea-nota" id="" cols="30" rows="10"><?php echo $contents; ?></textarea>
            <input type="hidden" name="directorio" value="<?php echo $dir; ?>">
            <input type="hidden" name="nota" value="<?php echo $note; ?>">
            <br>
            <p class="crearnota-p">
                <button type="submit" name="save" class="button-guardar" value="salvar">Guardar</button>
            </p>
        </form>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>