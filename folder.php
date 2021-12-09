<?php 
    if(isset($_POST['createfolder'])){
        $foldername = $_POST['name'];
        $path = $_POST['path'];
        $folderpath = $path . '/' . $foldername;
        createFolder($folderpath, $path);
        die();
    }else{
        header('Location: index.php?path=' . $path);
        die();
    }

    function createFolder($folderpath, $path){

        if(!file_exists($folderpath)){

            if(mkdir($folderpath)){
                header('Location: index.php?path=' . $folderpath);
            }else{
                $_SESSION['errormessage'] = 'La operación no se pudo completar con éxito';
                header('Location: index.php?path=' . $path); 
            }

        }else{
            session_start();
            $_SESSION['folderexist'] = true;
            header('Location: index.php?path=' . $path);
        }
    }

?>

