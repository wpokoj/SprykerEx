<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\MoonTransfer;
use Pyz\Zed\Planet\Business\PlanetFacade;
use Pyz\Zed\Planet\Persistence\PlanetEntityManager;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method PlanetFacade getFacade()
 */
class MoonEditController extends AbstractController  {

    public function indexAction(Request $request) {

        try {
            $idMoon = $this->castId($request->query->get('id-moon'));
        }
        catch(\Exception $e) {
            $this->addErrorMessage('Invalid Moon ID');
            return $this->redirectResponse('/planet/moon-list');
        }

        $moonTransfer = $this->getFacade()->findMoonEntity($idMoon);

        if($moonTransfer === null) {
            $this->addErrorMessage('Planet with id = '.$idMoon.' not found!');
            return $this->redirectResponse('/planet/moon-list');
        }

        $planetForm = $this->getFactory()
            ->createMoonForm($moonTransfer)
            ->handleRequest($request);

        if($planetForm->isSubmitted() && $planetForm->isValid()) {

            $moon = $planetForm->getData();

            $this->getFacade()
                ->editMoonEntity($moon);

            $this->addSuccessMessage('Moon edited successfully');

            return $this->redirectResponse('/planet/moon-list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }
}
