<?php

namespace App\Controllers;

use App\Components\Response;

class SomeController {
    public function someMethod() : Response {
        return new Response(200, 'testing');
    }    
}