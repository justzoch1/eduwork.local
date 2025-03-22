<?php

abstract class Crud {

    protected PDO $conn;
    protected function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public const ERROR_MESSAGE = 'Возникла ошибка, пересмотрите свой запрос.';

    abstract public function show();
    abstract public  function delete();
    abstract public  function create();
    abstract public  function update();

}