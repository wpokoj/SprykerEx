<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PlanetTransfer;
use Pyz\Zed\Planet\Business\PlanetFacade;
use Pyz\Zed\Planet\Persistence\PlanetEntityManager;
use Pyz\Zed\Planet\Persistence\PlanetRepository;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 * @method PlanetFacade getFacade()
 */

class PlanetEditController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        try {
            $idPlanet = $this->castId($request->query->get('id-planet'));
        }
        catch(\Exception $e) {
            $this->addErrorMessage('Invalid Planet ID');
            return $this->redirectResponse('/planet/planet-list');
        }

        $planetTransfer = $this->getFacade()->findPlanetEntity($idPlanet);

        if($planetTransfer === null) {
            $this->addErrorMessage('Planet with id = '.$idPlanet.' not found!');
            return $this->redirectResponse('/planet/planet-list');
        }

        $planetForm = $this->getFactory()
            ->createPlanetForm($planetTransfer)
            ->handleRequest($request);

        if ($planetForm->isSubmitted() && $planetForm->isValid()) {
            $this->getFacade()->editPlanetEntity($planetForm->getData());

            $this->addSuccessMessage('Planet updated successfully');
            return $this->redirectResponse('/planet/planet-list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }
}


