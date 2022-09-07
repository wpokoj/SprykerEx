<?php

namespace Pyz\Yves\Planet\Controller;

use Generated\Shared\Transfer\PlanetTransfer;
use Pyz\Client\Planet\PlanetClientInterface;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method PlanetClientInterface getClient()
 */
class RecommendController extends AbstractController {

    public function indexAction(Request $req) {
        $data = (new PlanetTransfer());

        if(($temp = $req->query->get('temp')) !== null) {
            $data->setAverageTemperature(floatval($temp));
        }

        if(($dist = $req->query->get('dist')) !== null) {
            $data->setAverageDistance(intval($dist));
        }

        if(($type = $req->query->get('type')) !== null) {
            $data->setType(strval($type));
        }

        //var_dump($data);

        var_dump($temp);
        var_dump($dist);
        var_dump($type);

        $searchResults = $this->getClient()->getRecommendedPlanets($data);

        return $this->view(
            [
                'planet' => $searchResults,
            ],
            [],
            '@Planet/views/index/index.twig'
        );
    }
}
