<?php

namespace Pyz\Zed\Planet\Communication\Controller;


use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Orm\Zed\Planet\Persistence\PyzMoonQuery;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
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

            $this->addInfoMessage(json_encode($planetForm->getData()->toArray()));
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

            $this->addInfoMessage(json_encode($planetForm->getData()->toArray()));

            return $this->redirectResponse('/planet/moon/list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }

    public function deleteAction(Request $request) {

    }
}
