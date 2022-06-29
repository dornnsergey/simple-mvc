<?php

declare(strict_types=1);

namespace App;

class App
{
    private static DB $db;

    public function __construct(private Router $router, private array $request, Config $config)
    {
        static::$db = new DB($config->db);
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        } catch (Exceptions\RouteNotFoundException) {
            http_response_code(404);
            exit(View::make('errors/404'));
        } catch (\App\Exceptions\ViewNotFoundException) {
            http_response_code(404);
            exit(View::make('errors/view_not_found'));
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
}