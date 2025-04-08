<?php
 abstract class Controller{
    public function render($view, $viewBag=[]){
        $file="Views/".static::class."/$view";
        //para reemplazar la palabra Controllers de la direcccion
        $file=str_replace("Controller","",$file);
        //echo $file;
        if(is_file($file)){
            extract($viewBag);
            ob_start();//abre el buffer
            require($file);
            $content=ob_get_contents();
            ob_end_clean();//cerrando el buffer
            echo $content;
        }
        else{
            echo "<h1>View not found</h1>";
        }
    
    
    }
 }