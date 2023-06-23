<?php

namespace Response;

use Error;
use Template\Template;

class Response
{
    private $req;
    private $template;
    private $render_mode;

    function __construct($req)
    {
        $this->req = $req;
        $this->template = (new Template);
        $this->template->set_var("req", $this->req);
        if (isset($req['query'])) {
            $this->template->set_var("query", $req['query']);
        }
        if (isset($req['body'])) {
            $this->template->set_var("body", $req['body']);
        }
        $this->render_mode = "";
    }

    protected function set_render_mode(string $mode): void
    {
        $this->render_mode = $mode;
    }

    public function get_render_mode(): string
    {
        return $this->render_mode;
    }

    public function render(string $template, array $args): void
    {
        $this->set_render_mode("template");
        $this->template->set_template($template);
        $this->template->get_args($args);
    }

    public function send($data): void
    {
        $this->set_render_mode("raw");
        print $data;
    }

    public function json(...$args): void
    {
        /** 
         *  $args[0]: @string - message to json encode;
         *  $args[1]: @integer - status code to send to client;
         */

        /** Set render mode */
        $this->set_render_mode("api");

        /** Set status response code */
        if (isset($args[1])) {
            $status_code = $args[1];
            $valid_status_codes = array(100, 101, 200, 201, 202, 203, 204, 205, 206, 207, 208, 226, 300, 301, 302, 303, 304, 305, 307, 308, 400, 401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 421, 422, 423, 424, 426, 428, 429, 431, 444, 451, 499, 500, 501, 502, 503, 504, 505, 506, 507, 508, 510, 511, 599);
            if (in_array($status_code, $valid_status_codes)) {
                http_response_code($args[1]);
            } else {
                throw new Error("Invalid status code");
            }
        }

        /** Print data */
        print json_encode($args[0]);
    }
}
