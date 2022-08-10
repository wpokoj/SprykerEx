<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 */
class CreateController extends AbstractController {
    public function indexAction(Request $request) {
        $planetForm = $this->getFactory()
            ->createPlanetForm()
            ->handleRequest($request);

        if ($planetForm->isSubmitted() && $planetForm->isValid()) {

            $data = ($planetForm->getData());

            assert($data instanceof PlanetTransfer);

            $transfer = new PyzPlanetEntityTransfer();
            $transfer->fromArray($data->toArray());

            //die();

            $transfer = $this->getFacade()->createPlanetEntity($transfer);

            $this->addSuccessMessage('Planet was created.');
            return $this->redirectResponse('/planet/list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }
}
