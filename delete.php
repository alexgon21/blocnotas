<?php 
    if(isset($_GET['path'])){
        $path = $_GET['path'];
        deleteDirectory($path);

        $currentElement = explode("/", $path);
        $last = count($currentElement) - 1;
        $currentPath = str_replace("/" . $currentElement[$last] , "", $path  );
        header('Location: index.php?path=' . $currentPath);
        die();
    }

    function deleteDirectory( $dir) {
        if(is_file($dir)){
            @unlink($dir);
            return;
        }
        if(!$dh = opendir($dir)){
            return;
        }
        while (false !== ($current = readdir($dh))) {
            if($current != '.' && $current != '..') {
                echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';
                if (!@unlink($dir.'/'.$current)) 
                    deleteDirectory($dir.'/'.$current);
            }       
        }
        closedir($dh);
        echo 'Se ha borrado el directorio '.$dir.'<br/>';
        @rmdir($dir);
    }
?>

