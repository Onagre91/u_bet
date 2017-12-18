<?php


class Controller {

	protected $request = array();

	public function __construct() {
		if (isset($_POST)) {
			$this->request = $_POST;
		}
	}

    public function render($view, $layout = "default", $scope = []) {
        extract($scope);
        ob_start();
        $success = include(ROOT . "views/" . lcfirst(str_replace("Controller", '', get_class($this))) . "/" . $view . ".php");
        $content_for_layout = ob_get_clean();
        if (!$success) {
            var_dump("Echec Render");
            var_dump($success);
            var_dump($content_for_layout);
            require(ROOT . "views/error404.php");
        }
        else {
            require(ROOT . "views/layout/" . $layout . ".php");
        }
    }

    public function loadModel($name) {
        require_once(ROOT . "models/" . $name . "Model.php");
        $model = ucfirst($name) . 'Model';
        return $this->$name = new $model();
    }
    
    public function _home() {
        $this->render("home", lcfirst(str_replace("Controller", '', get_class($this))));
    }
}