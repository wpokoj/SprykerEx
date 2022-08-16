<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ViewController extends AbstractController {


    public function viewAction(Request $request) {

        $id = $this->castId($request->get('idPlanet'));
        (new PlanetTransfer())->getPyzMoon();
        (new PyzPlanetEntityTransfer())->getPyzMoons();
    }
}
