<?php

namespace Pyz\Zed\Planet\Communication\Controller;


use Generated\Shared\Transfer\PlanetTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 */
class MoonlistController extends AbstractController {
    /**
     * @return array
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function indexAction(): array {
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
}
