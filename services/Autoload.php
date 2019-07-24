<?php

class Autoload
{
    public function loadClass($className)
    {
        $className = str_replace('\\', '/', $className);
        $file = $_SERVER['DOCUMENT_ROOT'] .
            "/{$className}.php";
        if (file_exists($file)) {
            include $file;
        }
    }
}
