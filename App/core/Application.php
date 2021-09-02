<?php 

namespace App\core;

use App\core\Request;
use App\core\router\Router;
use App\core\Response;
use App\core\router\Routes;


class Application
{
    public static Application $app;
    public static string $ROOT;

    public Router $router;
    public Request $request;
    public Response $response;


    private function __construct($DirRoot)
    {
        self::$app = $this;
        self::$ROOT = $DirRoot;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }


    public static function get_instance($DirRoot = NULL)
    {
        if (!isset(self::$app))
        {
            self::$app = new Application($DirRoot);
            Routes::getRoutes();
        }
        return self::$app;
    }

    public function run()
    {
        $result = $this->router->resolve();

        if (is_array($result)) {
            $this->response->setContentType('application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
            return;
        }

        echo $result;
    }
}