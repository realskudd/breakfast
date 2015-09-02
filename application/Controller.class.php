<?php

class Controller
{
    /** @var array */
    public $viewData = array();

    /**
     * @param string $uri
     *
     * @return self
     * @throws Exception
     */
    public static function factory($uri)
    {
        list($controllerName) = explode('/', $uri);

        if ($controllerName == '') $controllerName = 'Index';

        $controllerClassName = 'Controller_' . ucwords($controllerName);

        if (class_exists($controllerClassName)) {
            $controllerObject = new $controllerClassName();
        } else  {
            throw new Exception('Controller not found: ' . $controllerName);
        }

        return $controllerObject;
    }

    public function handle($uri)
    {
        $args = explode('/', $uri);

        $controllerName = array_shift($args);
        $methodName = array_shift($args);

        if ($controllerName == '') $controllerName = 'Index';
        if ($methodName == '') $methodName = 'index';

        if (method_exists($this, $methodName)) {
            $result = call_user_func_array(array($this, $methodName), $args);
        } else {
            throw new Exception('Controller method not found: ' . $methodName);
        }

        if ($_GET['output'] == 'json') {
            ob_clean();
            echo json_encode($this->viewData);
            exit();
        }

        if ($result !== false) {
            $view = View::factory($controllerName, $methodName, $this->viewData);
            $view->render();
        }
    }

    public function setViewData($name, $value)
    {
        $this->viewData[$name] = $value;
    }

    public function getActiveUser()
    {
        return Bootstrap::singleton()->getActiveUser();
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }

    public function url()
    {
        return call_user_func_array(array('Bootstrap', 'url'), func_get_args());
    }

    public function bounce()
    {
        if (isset($_SESSION['bounce-url'])) {
            $redirectUrl = explode('/', $_SESSION['bounce-url']);
            unset($_SESSION['bounce-url']);
        } else {
            $redirectUrl = array();
        }

        $this->redirect(call_user_func_array(array($this, 'url'), $redirectUrl));
    }

    public function error($title, $message)
    {
        $viewData = ['errorTitle' => $title, 'errorMessage' => $message];
        View::factory('_core', 'error', $viewData)->render();
    }

    public function getSoapClient($serviceName, $initParameter = null, $version = null)
    {
        return SoftLayer::getSoapClient($serviceName, $initParameter, $version);
    }
}