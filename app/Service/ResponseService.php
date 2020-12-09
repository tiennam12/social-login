<?php

namespace App\Service;

class ResponseService
{
    function __construct() {
        $this->success = false;
    }

    public $errors = [
        'userMessage' => '',
        'internalMessage' => '',
    ];
    public $success;
    public $message;
    public $data;
}
