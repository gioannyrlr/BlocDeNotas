<?php

    if(isset($_GET['dir'])){
        $dir = $_GET['dir'];
        $message = "";

        if(isset($_POST['crear-nota'])){
            if($_POST['crear-nota'] == 'create'){
                if(isset($_POST['nombre-nota']) && isset($_POST['textarea-nota-1']) && isset($_POST['directorio'])){
    
                    $message = '';
                    $name = $_POST['nombre-nota'];
                    $directorio = $_POST['directorio'];
                    $content = $_POST['textarea-nota-1'];
    
                    $my_dir = "archivos/$directorio/$name.txt";

                    try{
                        if(file_exists($my_dir)){
                            $message = "La nota $name.txt ya existe.";
                        }else{
                            $archivo = fopen($my_dir,'a');
                            fputs($archivo, $content);
                            fclose($archivo);
        
                            header('Location: directorio.php?dir=' . $dir);
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
    
        unset($_POST['crear-nota']);
        unset($_POST['nombre']);

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

    <div class="container">
        <div class="container-url">
            <p>
                <a href="abrir.php" style="text-decoration: none;">
                    <img src="./assets/img/folder-icon.png" alt="Logo" width="25" height="24" style="margin: 0px 2px 0px 2px; background-color: transparent !important;" class="d-inline-block align-text-top">
                </a>
                > <a href="abrir.php">Directorios</a> > <?php echo $dir ?></a>
            </p>
        </div>
        <br>
        <p class="crearnota-p">
            <button class="button-crearnota" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Crear una nueva nota</button>
        </p>

        <div class="collapse" id="collapseExample">
            <form action="directorio.php?dir=<?php echo $dir ?>" method="post">
                <p>
                    <input type="text" name="nombre-nota" class="input-nota" placeholder="Nombre" styles="padding: 2px 4px 2px 4px">.txt
                </p>
                <textarea name="textarea-nota-1" class="textarea-nota-1" id="" cols="30" placeholder="Contenido" rows="10"></textarea>
                <br>
                <input type="hidden" name="directorio" value="<?php echo $dir ?>">
                <p class="crearnota-p">
                    <button type="submit" name="crear-nota" class="button-crearnota2" value="create">Crear</button>
                </p>
            </form> 
            <br>               
        </div>

        <div class="container-p">
            <p style="display: flex !important; justify-content: center !important; color: transparent; !important"><?php echo $message ?></p>
        </div>

        <div class="row">

        <?php 

        $directorio = "archivos/" . $dir;
        $ficheros1  = scandir($directorio);

        if(count($ficheros1) > 2){
            foreach($ficheros1 as $valor){
                if ('.' !== $valor && '..' !== $valor){
                    $file = "archivos\\" . $dir . '\\' . $valor;

                    if(filesize($file) > 0){
                        $contents = file_get_contents($file, FILE_USE_INCLUDE_PATH);

        ?>

        <div class="list-group" style="width: 100%; border: 0.5px solid #232323 !important; margin: 5px 0px 5px 0px !important;">
            <li class="list-group-item">
                <img src="./assets/img/txt-icon.png" alt="Logo" width="14" height="18" style="margin: 0px 2px 0px 2px; background-color: transparent !important;" class="d-inline-block align-text-top">
                <h5 class="list-title" style="background-color: transparent !important; display: inline; margin-left: 4px;"><?php echo substr($valor ,0 , (strlen($valor) - 5)); ?></h5>
                <p class="list-text" style="background-color: transparent !important; margin-top: 5px !important;"><i style="background-color: transparent !important; color: #818181 !important;"><?php echo substr($contents, 0, 60); ?>...</i></p>
                <h6 class="card-subtitle mb-2 text-muted" style="background-color: transparent !important;"><?php echo filesize($file) ?> bytes</h6>
                <a href="nota.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="list-link-edit" style="background-color: transparent !important;"><i class="bi bi-pencil-square" style="background-color: transparent !important;"></i></a>
                <a href="delete.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>&delete=1" class="list-link-del" style="background-color: transparent !important;"><i class="bi bi-trash3" style="background-color: transparent !important;"></i></a>
            </li>
        </div>

        <?php

                    } else{

        ?>

        <div class="list-group" style="width: 100%; border: 0.5px solid #232323 !important; margin: 5px 0px 5px 0px !important;">
            <li class="list-group-item">
                <img src="./assets/img/txt-icon.png" alt="Logo" width="14" height="18" style="margin: 0px 2px 0px 2px; background-color: transparent !important;" class="d-inline-block align-text-top">
                <h5 class="list-title" style="background-color: transparent !important; display: inline; margin-left: 4px;"><?php echo $valor ?></h5>
                <p class="list-text" style="background-color: transparent !important;  color: #818181 !important; margin-top: 5px;">Sin nada escrito...</p>
                <h6 class="card-subtitle mb-2 text-muted" style="background-color: transparent !important;"><?php echo filesize($file) ?> bytes</h6>
                <a href="nota.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="list-link-edit" style="background-color: transparent !important;"><i class="bi bi-pencil-square" style="background-color: transparent !important;"></i></a>
                <a href="delete.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>&delete=1" class="list-link-del" style="background-color: transparent !important;"><i class="bi bi-trash3" style="background-color: transparent !important;"></i></a>
            </li>
        </div>

        <?php

                    }
                }
            }
        }

        ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>