<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PlanetController extends AbstractController {

    public function createAction(Request $request) {
        $planetForm = $this->getFactory()
            ->createPlanetForm()
            ->handleRequest($request);

        if ($planetForm->isSubmitted() && $planetForm->isValid()) {

            $data = ($planetForm->getData());

            $transfer = $this->getFacade()->createPlanetEntity($data);

            $this->addSuccessMessage('Planet was created.');
            return $this->redirectResponse('/planet/planet/list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }

    public function deleteAction(Request $request) {

        try {
            $idPlanet = $this->castId($request->query->get('id-planet'));
        }
        catch(\Exception $e) {
            $this->addErrorMessage('No planet id given');
            return $this->redirectResponse('/planet/planet/list');
        }

        $planetTransfer = $this->getFacade()->findPlanetEntity($idPlanet);

        if($planetTransfer === null) {
            $this->addErrorMessage('Planet with id = '.$idPlanet.' not found!');
            return $this->redirectResponse('/planet/planet/list');
        }

        $this->getFacade()
            ->deletePlanetEntity($planetTransfer);

        $this->addInfoMessage('Planet deleted successfully');
        return $this->redirectResponse('/planet/planet/list');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request)
    {
        $idPlanet = $this->castId($request->query->get('id-planet'));

        $planetTransfer = $this->getFacade()->findPlanetEntity($idPlanet);

        if($planetTransfer === null) {
            $this->addErrorMessage('Planet with id = '.$idPlanet.' not found!');
            return $this->redirectResponse('/planet/planet/list');
        }

        $planetForm = $this->getFactory()
            ->createPlanetForm($planetTransfer)
            ->handleRequest($request);

        if ($planetForm->isSubmitted() && $planetForm->isValid()) {

            $this->getFacade()->editPlanetEntity($planetForm->getData());

            //(new PlanetEntityManager())->editEntity($planetForm->getData());

            $this->addSuccessMessage('Planet was updated.');
            return $this->redirectResponse('/planet/planet/list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }

    public function listAction(): array {
        $planetTable = $this->getFactory()->createPlanetTable();

        return $this->viewResponse([
            'planetTable' => $planetTable->render()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function tableAction(): JsonResponse {

        $planetTable = $this->getFactory()->createPlanetTable();

        return $this->jsonResponse($planetTable->fetchData());
    }
}
