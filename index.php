<?php
error_reporting(E_ALL);


define("DS",DIRECTORY_SEPARATOR);

spl_autoload_register(function ($className){
    $classPath = str_replace('_','/',$className);
    require_once ($classPath.".php");

});

// require_once 'Controller/Core/Action.php';
// require_once 'View/html/header.phtml';
// require_once 'Controller/Core/Front.php';

$request = new Model_Core_Request();
class Ccc extends Controller_Core_Action 
{

    //static function
    public static function init()
    {
        $front = new Controller_Core_Front();
        $front->init();

    }

    public static function getModel($className)
    {
        $className = 'Model_'.$className;
        return (new $className());
    }

    public static function getSingleTon($className)
    {
        $className = 'Model_'.$className;

        if (array_key_exists($className, $GLOBALS)){
            return $GLOBALS[$className];
        }
        $GLOBALS[$className] = (new $className());
        return $GLOBALS[$className];
    }

    public static function setRegister($key, $value)
    {
        $GLOBALS[$key] = $value;
    }

    public function getRegistry($key= null)
    {
        if(array_key_exists($key,$GLOBALS)){
            return $GLOBALS[$key];
        }
        return false;
    }

}
Ccc::init();

?>
