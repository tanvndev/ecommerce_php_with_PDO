<?php
class App
{
    // http://localhost/WEB2041_Ecommerce/Home/Default/1/2/3
    protected $controller = 'Home';
    protected $action = 'Default';
    protected $params = [];

    public function __construct()
    {
        $url = $this->handleUrl();

        if (empty($url)) {
            $this->controller = 'Home';
        } else {
            if (!empty($url[0]) && file_exists('./app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                $this->controller = 'Other';
            }
        }

        require_once './app/controllers/' . $this->controller . '.php';
        $controllerInstance = new $this->controller();

        //handle actions
        if (!empty($url[1]) && method_exists($controllerInstance, $url[1])) {
            $this->action = $url[1];
            unset($url[1]);
        }

        //handle params
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$controllerInstance, $this->action], $this->params);
    }

    protected function handleUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(trim($_GET['url'], '/')));
        }
    }
}
