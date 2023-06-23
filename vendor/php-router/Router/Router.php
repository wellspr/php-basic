<?php

namespace Router;

use Response\Response;
use Template\Template;

class Router
{
    private $request_uri;
    private $req;
    private $template;
    private $routes;
    private $render_mode;

    function __construct()
    {
        $this->request_uri = "";
        $this->req = array();
        $this->template = (new Template);
        $this->routes = array();
        $this->render_mode = "";
    }

    protected function get_server(): void
    {
        foreach ($_SERVER as $key => $value) {
            $this->req[strtolower($key)] = $value;
        }
    }

    private function match(string $request_uri, string $path): bool
    {
        /** Matches
         *      Check if $request_uri matches $path
         *      1) Must be of the same size;
         *      2) If some param is passed in, aggregate it to $req;
         */
        $request_array = explode("/", ltrim($request_uri, "/"));
        $path_array = explode("/", ltrim($path, "/"));
        $match = false;
        
        if (count($request_array) === count($path_array)) {
            $index = 0;
            foreach ($path_array as $item) {
                if ($item === $request_array[$index]) {
                    $match = true;
                } else if ($item && $item[0] === ":") {
                    $this->req[substr($item, 1)] = $request_array[$index];
                    $match = true;
                } else {
                    $match = false;
                    break;
                }
                $index += 1;
            }
        }
        return $match;
    }

    private function load_query_data(): void
    {
        /** GET requests
         *  If queries are passed in load then into $req
         */
        if ($_SERVER['QUERY_STRING']) {
            $this->req['query'] = $_GET;
            $this->request_uri = explode("?", $this->request_uri)[0];
        }
    }

    private function load_body_data(): void
    {
        /** POST requests
         *  load the body of post request into $req
         */
        parse_str(file_get_contents('php://input'), $body);
        $this->req['body'] = $body;
    }

    private function route(string $method, string $path, $callback)
    {
        $this->get_server();
        $this->request_uri = $this->req['request_uri'];

        if ($this->req['request_method'] === strtoupper($method)) {

            if (strtolower($method) === "get") {
                $this->load_query_data();
            }

            if (strtolower($method) === "post" || strtolower($method) === "put") {
                $this->load_body_data();
            }

            $match = $this->match($this->request_uri, $path);
            if ($match) {
                return array(
                    "path" => $path,
                    "req" => $this->req,
                    "callback" => $callback,
                );
            }
        }
    }

    public function register_route(string $method, string $path, $callback): void
    {
        array_push($this->routes, array(
            "method" => strtolower($method),
            "path" => $path,
            "callback" => $callback
        ));
    }

    function get_routes(): array
    {
        return $this->routes;
    }

    private function content()
    {
        $data = array();
        foreach ($this->routes as $route) {
            $method = $route['method'];
            $path = $route['path'];
            $callback = $route['callback'];

            $content = $this->route($method, $path, $callback);
            if ($content) {
                array_push($data, $content);
            }
        }
        return $data;
    }

    function run()
    {
        if ($this->content()) {
            $callback = function () {
                foreach ($this->content() as $content) {
                    $req = $content['req'];
                    $response = new Response($req);
                    $content['callback']($req, $response);
                    $this->render_mode = $response->get_render_mode();
                }
            };

            $callback();

            if ($this->render_mode === "template") {
                $this->template->output();
            }
        } 
        else {
            http_response_code(404);
            $this->template->error_page();
        }
    }
}
