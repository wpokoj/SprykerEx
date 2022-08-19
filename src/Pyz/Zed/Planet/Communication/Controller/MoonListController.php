<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MoonListController extends AbstractController  {

    public function indexAction(Request $request) {

        $planetTable = $this->getFactory()->createMoonTable();

        return $this->viewResponse([
            'planetTable' => $planetTable->render()
        ]);
    }

    public function tableAction(): JsonResponse {

        $planetTable = $this->getFactory()->createMoonTable();

        return $this->jsonResponse($planetTable->fetchData());
    }
}
