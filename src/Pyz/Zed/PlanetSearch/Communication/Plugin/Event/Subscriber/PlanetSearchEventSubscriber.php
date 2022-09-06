<?php

namespace Pyz\Zed\PlanetSearch\Communication\Plugin\Event\Subscriber;

use Pyz\Zed\Planet\Dependency\PlanetEvents;
use Pyz\Zed\PlanetSearch\Communication\Plugin\Event\Listener\PlanetSearchListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;


/**
 * @method \Pyz\Zed\PlanetSearch\Business\PlanetSearchFacadeInterface getFacade()
 */
class PlanetSearchEventSubscriber extends AbstractPlugin implements EventSubscriberInterface {

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection) {

        $eventCollection->addListenerQueued(PlanetEvents::ENTITY_PYZ_PLANET_CREATE, new PlanetSearchListener());
        $eventCollection->addListenerQueued(PlanetEvents::ENTITY_PYZ_PLANET_UPDATE, new PlanetSearchListener());
        $eventCollection->addListenerQueued(PlanetEvents::ENTITY_PYZ_PLANET_DELETE, new PlanetSearchListener());

        return $eventCollection;
    }
}

