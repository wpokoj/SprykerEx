<?php

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Generated\Shared\Transfer\PyzPlanetEntityTransfer;
use Orm\Zed\Planet\Persistence\PyzPlanet;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Pyz\Zed\Planet\Communication\Other\WaveFunctionCollapse;
use Pyz\Zed\Planet\Communication\Table\PlanetTable;
use Pyz\Zed\Planet\Persistence\PlanetRepository;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Propel\Runtime\Collection\ObjectCollection;

class ThrowawayDebugController extends AbstractController {

    public function indexAction() {

        (new GatewayController())->getPlanetCollectionAction(new PlanetCollectionTransfer());

        //var_dump((new PlanetRepository())->findPlanets());
        //die();

        //(new WaveFunctionCollapse())->render();

        //var_dump((new PlanetTable(new PyzPlanetQuery()))->createMoonDropdown(7,new PyzPlanetQuery()));
        //die();

        //$data = (new PlanetRepository())->moonPlanetGetById(7);

        //print_r($arr = $data);

        /*foreach ($arr as $planet) {

            //$trans = (new PyzPlanetEntityTransfer())->fromArray($planet);
            echo '<br><br>';
            print_r($planet);
        }*/

        var_dump($data = (new PyzPlanetQuery())->leftJoinWithPyzMoon()->find()->toArray());

        echo '<br><br>';

        var_dump((new PlanetTransfer())->fromArray($data[0])->getPyzMoons());

        echo '<br><br>';

        var_dump((new PyzPlanetEntityTransfer())->fromArray($data[0])->getPyzMoons());

        die();

        return [];
    }

    public function reqAction(Request $request) {



        //var_dump($request);
        //die();

        $name = $request->request->get('planetName');
        $fact = $request->request->get('fact');

        if($name == '' || $fact == '') {
            return [
                'error' => 'Cannot add empty entry!',
                'name' => $name,
                'fact' => $fact,
            ];
        }

        $transfer = new PyzPlanetEntityTransfer();
        $transfer->setName($name);
        $transfer->setInterestingFact($fact);

        $transfer = $this->getFacade()->createPlanetEntity($transfer);

        return [
            'name' => $transfer->getName(),
            'fact' => $transfer->getInterestingFact(),
        ];


    }
}
