<?php

namespace App\Traits;

trait PageSetup
{
    private $error = 'Noget gik galt under håndteringen af din forespørgsel. En log med fejlen er oprettet. Beklager ulejligheden.';
    private $page = 1;
    private $type = 'all';
    private $amount = 100;

    private function pageSetup()
    {
        isset($_GET['page']) ? $this->page = $_GET['page'] : $this->page = 1;
        isset($_GET['type']) ? $this->type = $_GET['type'] : $this->type = 'all';
        isset($_GET['amount']) ? $this->amount = $_GET['amount'] : $this->amount = 100;
    }
}
