<?php

namespace App\Services;

use App\Contracts\PaginationServiceContract;

class PaginationService implements PaginationServiceContract
{

    public function getPaginationParams()
    {
        $params = collect();

        isset($_GET['page']) ? $params->put('page', $_GET['page']) : $params->put('page', 1);
        isset($_GET['amount']) ? $params->put('amount', $_GET['amount']) : $params->put('amount', 100);
        isset($_GET['type']) ? $params->put('type', $_GET['type']) : $params->put('type', 'all');

        return $params; 
    }
}