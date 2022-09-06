<?php

namespace Pyz\Yves\Planet\Controller;

use Generated\Shared\Transfer\PlanetTransfer;
use Pyz\Client\Planet\PlanetClientInterface;
use Spryker\Yves\Kernel\Controller\AbstractController;

/**
 * @method PlanetClientInterface getClient()
 */
class RecommendController extends AbstractController {

    public function indexAction() {
        $data = (new PlanetTransfer())
            ->setAverageTemperature(0.0);
            //->setType('Gas giant');

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
