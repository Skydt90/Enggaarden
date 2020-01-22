<?php

namespace App\Traits;

trait PageSetup
{
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';
    
    private function pageSetup()
    {
        $params = collect();

        isset($_GET['page']) ? $params->put('page', $_GET['page']) : $params->put('page', 1);
        isset($_GET['amount']) ? $params->put('amount', $_GET['amount']) : $params->put('amount', 100);
        isset($_GET['type']) ? $params->put('type', $_GET['type']) : $params->put('type', 'all');

        return $params; 
    }
}