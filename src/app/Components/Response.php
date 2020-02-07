<?php declare(strict_types = 1);

namespace App\Components;

class Response
{
    private $statusCode = 200;
    private $responseText;

    public function __construct(int $statusCode, string $responseText) {
        $this->statusCode = $statusCode;
        $this->responseText = $responseText;
    }

    public function getResponseText() {
        return $this->responseText;
    }
}