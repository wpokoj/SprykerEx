<?php

namespace Pyz\Yves\Planet\Controller;

use Pyz\Client\Planet\PlanetClient;
use Pyz\Client\PlanetSearch\PlanetSearchClient;
use Pyz\Client\PlanetSearch\Plugin\Elasticsearch\Query\PlanetSearchQueryPlugin;
use Spryker\Client\Search\SearchClient;
use Spryker\Yves\Kernel\Controller\AbstractController;

/**
 * @method PlanetClient getClient()
 */
class IndexController extends AbstractController {
    /**
     * @param int $limit
     *
     * @return \Spryker\Yves\Kernel\View\View
     */
    public function indexAction(string $name) {
        $searchResults = $this->getClient()->getPlanetByName($name);

        return $this->view(
            [
                'planet' => $searchResults,
            ],
            [],
            '@Planet/views/index/index.twig'
        );
    }


}