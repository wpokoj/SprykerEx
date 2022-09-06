<?php

namespace Pyz\Zed\PlanetSearch\Communication\Plugin\Event\Listener;

use Pyz\Zed\Planet\Dependency\PlanetEvents;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\PlanetSearch\Business\PlanetSearchFacadeInterface getFacade()
 */
class PlanetSearchListener extends AbstractPlugin implements EventHandlerInterface {

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     * @param string $eventName
     * @return void
     */
    public function handle(TransferInterface $transfer, $eventName): void {

        /** @var \Generated\Shared\Transfer\EventEntityTransfer $transfer */
        if ($eventName === PlanetEvents::ENTITY_PYZ_PLANET_CREATE) {
            $this->getFacade()->publish($transfer->getId());
        }

        switch ($eventName) {
            case PlanetEvents::ENTITY_PYZ_PLANET_CREATE:
                $this->getFacade()->publish($transfer->getId());
                return;
            case PlanetEvents::ENTITY_PYZ_PLANET_DELETE:
                $this->getFacade()->delete($transfer->getId());
                return;
            case PlanetEvents::ENTITY_PYZ_PLANET_UPDATE:
                $this->getFacade()->update($transfer->getId());
                return;
            default: return;
        }
    }

}

