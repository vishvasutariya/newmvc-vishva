<?php
require_once 'Controller/Core/Action.php';
/**
 * 
 */
class Controller_Core_Front extends Controller_Core_Action 
{
	
	 public function init()
	 {
	 	 $request=new Model_Core_Request();
	 	 $controllername=$request->getCOntrollerName();
	 	 $actionname=$request->getActionName()."Action";

	 	 $controllerclassname="Controller_".ucwords($controllername, "_");
	 	 $controllerclasspath=str_replace("_", "/", $controllerclassname);
	 	 require_once "{$controllerclasspath}.php";
	 	 $controller=new $controllerclassname();
	 	 if (method_exists($controller, $actionname==false))
	 	  {
	 	 	$controller->errorAction($actionname);
	 	 }
	 	 else{
	 	 	$controller->$actionname();
	 	 }
	 }
}
?>