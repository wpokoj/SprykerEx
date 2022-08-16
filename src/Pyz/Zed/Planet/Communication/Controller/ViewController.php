<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ViewController extends AbstractController {


    public function viewAction(Request $request) {

        $id = $this->castId($request->get('idPlanet'));

    }
}
