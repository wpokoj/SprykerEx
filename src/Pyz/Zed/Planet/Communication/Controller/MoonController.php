<?php

namespace Pyz\Zed\Planet\Communication\Controller;


use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Orm\Zed\Planet\Persistence\PyzMoonQuery;
use Pyz\Zed\Planet\Business\PlanetFacade;
use Pyz\Zed\Planet\Persistence\PlanetEntityManager;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 * @method PlanetFacade getFacade()
 */
class MoonController extends AbstractController {
    /**
     * @return array
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function listAction(): array {
        $planetTable = $this->getFactory()->createMoonTable();

        return $this->viewResponse([
            'planetTable' => $planetTable->render()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function tableAction(): JsonResponse {

        $planetTable = $this->getFactory()->createMoonTable();

        return $this->jsonResponse($planetTable->fetchData());
    }

    public function createAction(Request $request) {

        $planetForm = $this->getFactory()
            ->createMoonForm()
            ->handleRequest($request);

        if($planetForm->isSubmitted() && $planetForm->isValid()) {

            $this->getFacade()
                ->createMoonEntity($planetForm->getData());
            //$this->addInfoMessage(json_encode($planetForm->getData()->toArray()));
            $this->addSuccessMessage('Moon added successfully');

            return $this->redirectResponse('/planet/moon/list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }

    public function editAction(Request $request) {

        $idMoon = $this->castId($request->query->get('id-moon'));

        $moonTransfer = $this->getFacade()->findMoonEntity($idMoon);

        if($moonTransfer === null) {
            $this->addErrorMessage('Planet with id = '.$idMoon.' not found!');
            return $this->redirectResponse('/planet/moon/list');
        }

        $planetForm = $this->getFactory()
            ->createMoonForm($moonTransfer)
            ->handleRequest($request);

        if($planetForm->isSubmitted() && $planetForm->isValid()) {

            //$this->getFacade()
            //    ->editMoonEntity($planetForm->getData());



            $moon = $planetForm->getData();
            if(! $moon instanceof MoonTransfer) return null;

            $planet = $this->getFacade()->findPlanetEntity(
                $moon->getIdPlanet()
            );

            //$planet->addPyzMoons($moon);
            //$moon->setPyzPlanet($planet);

            // TODO: Temporary
            (new PlanetEntityManager())
                ->editMoonEntity($moon);

            $this->addSuccessMessage(json_encode($moon->toArray()));
            $this->addSuccessMessage('Moon edited successfully');

            return $this->redirectResponse('/planet/moon/list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }

    public function deleteAction(Request $request) {

    }
}
