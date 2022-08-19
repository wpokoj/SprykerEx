<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Pyz\Zed\Planet\Persistence\PlanetEntityManager;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PlanetDeleteController extends AbstractController {

    public function indexAction(Request $request) {

        try {
            $idPlanet = $this->castId($request->query->get('id-planet'));
        }
        catch(\Exception $e) {
            $this->addErrorMessage('No planet id given');
            return $this->redirectResponse('/planet/planet-list');
        }


        $planetTransfer = $this->getFacade()->findPlanetEntity($idPlanet);

        if($planetTransfer === null) {
            $this->addErrorMessage('Planet with id = '.$idPlanet.' not found!');
            return $this->redirectResponse('/planet/planet-list');
        }

        //(new PlanetEntityManager())->deleteEntity($planetTransfer);

        $this->getFacade()
            ->deletePlanetEntity($planetTransfer);

        $this->addInfoMessage('Planet deleted successfully');
        return $this->redirectResponse('/planet/planet-list');
    }
}
