<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Pyz\Zed\Planet\Business\PlanetFacade;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method PlanetFacade getFacade()
 */

class MoonDeleteController extends AbstractController  {

    public function indexAction(Request $request) {

        try {
            $idMoon = $this->castId($request->query->get('id-moon'));
        }
        catch(\Exception $e) {
            $this->addErrorMessage('No moon id given');
            return $this->redirectResponse('/planet/moon-list');
        }


        $moonTrans = $this->getFacade()->findMoonEntity($idMoon);

        if($moonTrans === null) {
            $this->addErrorMessage('Moon with id = '.$idMoon.' not found!');
            return $this->redirectResponse('/planet/moon-list');
        }

        try {
            $this->getFacade()
                ->deleteMoonEntity($moonTrans);
        }
        catch(\Exception $e) {
            $this->addErrorMessage('An error occurred while deleting moon');
            return $this->redirectResponse('/planet/moon-list');
        }

        $this->addSuccessMessage('Moon deleted successfully');
        return $this->redirectResponse('/planet/moon-list');
    }
}
