<?php
class App
{
    protected $controller = "";
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        if (!isset($_SESSION['username'])) {
            $this->controller = "Admin";
        } else {
            $this->controller = "Dashboardupbu";
        }


        $url = $this->parseURL();

        // controller
        $url[0] = ucfirst($url[0]);
        if (!empty($url[0])) {
            if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                $this->controller = "NotFound";
            }
        }


        // filter user level    
        $this->filterUser($this->controller);

        // merequire controller
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // jalankan controller & method, serta kirimkan parameter
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        } else {
            return [0, 0];
        }
    }

    public function filterUser($controller)
    {
        if (!isset($_SESSION['username'])) {

            switch ($controller) {
                case "Admin":
                    $this->controller = $controller;
                    break;
                case "Api":
                    $this->controller = $controller;
                    break;
                case "Apierror":
                    $this->controller = $controller;
                    break;
                case "Login":
                    $this->controller = $controller;
                    break;
                case "Logout":
                    $this->controller = $controller;
                    break;
                case "file":
                    $this->controller = "NotFound";
                    break;
                default:
                    $this->controller = "NotFound";
            }

            // if ($this->controller == 'Admin') {
            //     $this->controller = "Admin";
            // } elseif ($this->controller == 'Login') {
            //     $this->controller =  $this->controller;
            // } elseif ($this->controller == 'Register') {
            //     $this->controller =  $this->controller;
            // } elseif ($this->controller == 'Beranda' || $this->controller == 'Dashboard') {
            //     $this->controller =  'Admin';
            // } else {
            //     $this->controller = "NotFound";
            // }
        } else {
            if ($_SESSION['level'] == '0') {
                switch ($controller) {
                    case "Dashboardupbu":
                        $this->controller = $controller;
                        break;
                    case "Api":
                        $this->controller = $controller;
                        break;
                    case "Logout":
                        $this->controller = $controller;
                        break;
                    default:
                        $this->controller = "Dashboardupbu";
                }
            } elseif ($_SESSION['level'] == 1) {
                switch ($controller) {
                    case "Tenan":
                        $this->controller = $controller;
                        break;
                    case "Api":
                        $this->controller = $controller;
                        break;
                    case "Logout":
                        $this->controller = $controller;
                        break;
                    default:
                        $this->controller = "Tenan";
                }
            }
        }
    }
}