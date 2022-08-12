<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Pyz\Zed\Planet\Communication\Other\WaveFunctionCollapse;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddController extends AbstractController {

    public function indexAction() {
        (new WaveFunctionCollapse())->render();
        return [];
    }

    public function reqAction(Request $request) {



        //var_dump($request);
        //die();

        $name = $request->request->get('planetName');
        $fact = $request->request->get('fact');

        if($name == '' || $fact == '') {
            return [
                'error' => 'Cannot add empty entry!',
                'name' => $name,
                'fact' => $fact,
            ];
        }

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
