<?php

namespace App\Infraestructure;

use App\Service\BootstrapInterface;

class Bootstrap implements BootstrapInterface {

  public function create()
  {
    require __DIR__ . '/config/doctrine.php';
  }

}
