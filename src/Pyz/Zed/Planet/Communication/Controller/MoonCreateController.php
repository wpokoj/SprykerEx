<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MoonCreateController extends AbstractController  {

    public function indexAction(Request $request) {

        $planetForm = $this->getFactory()
            ->createMoonForm()
            ->handleRequest($request);

        if($planetForm->isSubmitted() && $planetForm->isValid()) {

            $this->getFacade()
                ->createMoonEntity($planetForm->getData());
            //$this->addInfoMessage(json_encode($planetForm->getData()->toArray()));
            $this->addSuccessMessage('Moon added successfully');

            return $this->redirectResponse('/planet/moon-list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }
}
