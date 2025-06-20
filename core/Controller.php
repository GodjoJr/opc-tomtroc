<?php
namespace Core;
abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        require_once ROOT_URL . '/app/views/' . $view . '.php';
    }

    protected function model(string $model): object
    {
        require_once ROOT_URL . '/app/models/' . $model . '.php';
        return new $model;
    }
}
