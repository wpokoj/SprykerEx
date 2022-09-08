<?php

namespace Pyz\Yves\PlanetWidget\Widget;

use Pyz\Yves\PlanetWidget\PlanetWidgetFactory;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method PlanetWidgetFactory getFactory()
 */
class PlanetWidget extends AbstractWidget {
    /**
     * @param string $planetName
     */
    public function __construct(string $planetName) {
        $this->addParameter('planet', $this->findPlanet($planetName));
    }

    /**
     * @return string
     */
    public static function getName(): string {
        return 'PlanetWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string {
        return '@PlanetWidget/views/planet/planet.twig';
    }

    /**
     * @param string $planetName
     *
     * @return array
     */
    protected function findPlanet(string $planetName): array {
        return ($this->getFactory()
            ->getPlanetClient()
            ->getPlanetByName($planetName)[0])
            ?? ['name' => 'planet not found'];
    }
}
