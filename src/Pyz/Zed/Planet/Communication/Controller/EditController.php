<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PlanetTransfer;
use Pyz\Zed\Planet\Persistence\PlanetEntityManager;
use Pyz\Zed\Planet\Persistence\PlanetRepository;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 */

class EditController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $idPlanet = $this->castId($request->query->get('id-planet'));

        $planetTransfer = $this->getFacade()->findPlanetEntity($idPlanet);

        if($planetTransfer === null) {
            $this->addErrorMessage('Planet with id = '.$idPlanet.' not found!');
            return $this->redirectResponse('/planet/list');
        }

        $planetForm = $this->getFactory()
            ->createPlanetForm($planetTransfer)
            ->handleRequest($request);

        if ($planetForm->isSubmitted() && $planetForm->isValid()) {

            $this->getFacade()->editPlanetEntity($planetForm->getData());

            //(new PlanetEntityManager())->editEntity($planetForm->getData());

            $this->addSuccessMessage('Planet updated successfully');
            return $this->redirectResponse('/planet/list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }
}


