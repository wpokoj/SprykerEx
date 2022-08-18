<?php

namespace Pyz\Zed\Planet\Communication;

use Generated\Shared\Transfer\MoonTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Orm\Zed\Planet\Persistence\PyzMoonQuery;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Pyz\Zed\Planet\Communication\Form\MoonForm;
use Pyz\Zed\Planet\Communication\Form\PlanetForm;
use Pyz\Zed\Planet\Communication\Table\MoonTable;
use Pyz\Zed\Planet\PlanetDependencyProvider;
use Pyz\Zed\Planet\Communication\Table\PlanetTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

class PlanetCommunicationFactory extends AbstractCommunicationFactory {

    public function __construct() {

    }

    /**
     * @return \Pyz\Zed\Planet\Communication\Table\PlanetTable
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createPlanetTable(): PlanetTable {
        return new PlanetTable(
            $this->getPlanetPropelQuery(),
            $this->getMoonPropelQuery(),
        );
    }
    /**
     * @return \Pyz\Zed\Planet\Communication\Table\MoonTable
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createMoonTable(): MoonTable {
        return new MoonTable($this->getMoonPropelQuery());
    }

    /**
     * @return \Orm\Zed\Planet\Persistence\PyzPlanetQuery
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getPlanetPropelQuery(): PyzPlanetQuery {
        return $this->getProvidedDependency(PlanetDependencyProvider::QUERY_PLANET);
    }

    /**
     * @return \Orm\Zed\Planet\Persistence\PyzMoonQuery
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getMoonPropelQuery(): PyzMoonQuery {
        return $this->getProvidedDependency(PlanetDependencyProvider::QUERY_MOON);
    }

    /**
     * @param \Generated\Shared\Transfer\PlanetTransfer|null $planetTransfer
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */

    public function createPlanetForm(?PlanetTransfer $planetTransfer = null, array $options = []): FormInterface {
        return $this->getFormFactory()->create(
            PlanetForm::class,
            $planetTransfer,
            $options
        );
    }

    /**
     * @param \Generated\Shared\Transfer\PlanetTransfer|null $planetTransfer
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */

    public function createMoonForm(?MoonTransfer $moonTransfer = null, array $options = []): FormInterface {
        return $this->getFormFactory()->create(
            MoonForm::class,
            $moonTransfer,
            $options
        );
    }
}
