<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddController extends AbstractController {

    public function indexAction() {
        return [];
    }

    public function reqAction(Request $request) {

        //var_dump($request);
        //die();

        $name = $request->request->get('planetName');
        $fact = $request->request->get('fact');

        $transfer = new PyzPlanetEntityTransfer();
        $transfer->setName($name);
        $transfer->setInterestingFact($fact);

        $transfer = $this->getFacade()->createPlanetEntity($transfer);

        return [
            'name' => $transfer->getName(),
            'fact' => $transfer->getInterestingFact(),
        ];


    }
}
