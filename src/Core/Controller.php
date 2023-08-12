<?php

namespace Mpftavares\FarmBackofficeOop\Core;

abstract class Controller
{

    protected function redirect(string $url): void
    {
        Response::redirect($url);
    }

    protected function render(string $name, array $data = null, bool $layout = true): void
    {
        View::render($name, $data, $layout);
    }

    protected function isPost()
    {
        return Request::isPost();
    }

    protected function json(mixed $data) {
        Response::json($data);
    }
}
