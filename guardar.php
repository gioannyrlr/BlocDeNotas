<?php

if(isset($_POST['save'])){
    if($_POST['save'] == "salvar"){
        if(isset($_POST['directorio']) && isset($_POST['nota']) && isset($_POST['textarea-nota'])){

            $dir = $_POST['directorio'];
            $note = $_POST['nota'];
            $content = $_POST['textarea-nota'];

            try{
                $file = "./archivos/" . $dir . '/' . $note;
                $gestor = fopen($file, "w");

                fwrite($gestor, $content);
                fclose($gestor);

                header('Location: directorio.php?dir=' . $dir);

            }catch(Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage(), "\n\n";
            }
        }else{
            header('Location: nuevo.php');
        }
    }else{
        header('Location: nuevo.php');
    }
}else{
    header('Location: nuevo.php');
}

?>