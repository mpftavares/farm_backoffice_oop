<?php

namespace Mpftavares\FarmBackofficeOop\Core;

abstract class Controller
{

    protected function redirect(string $url): void
    {
        header("Location: $url");
        die();
    }

    protected function render(string $name, array $data = null, bool $layout = true): void
    {
        $path = "../views/$name.phtml";

        if (!file_exists($path)) {
            header('HTTP/1.1 500 Internal Server Error');
            die('View not found');
        }

        $data['bag'] = FlashBag::has() ? FlashBag::get() : [];

        if (!is_null($data)) {
            extract($data);
        }


        if ($layout) {
            include "../views/common/header.phtml";
            include $path;
            include "../views/common/footer.phtml";
        } else {
            include $path;
        }
    }

    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    // protected function json(mixed $data) {
    //     header('Content-Type: application/json');
    //     echo json_encode($data, JSON_PRETTY_PRINT);
    // }
}
