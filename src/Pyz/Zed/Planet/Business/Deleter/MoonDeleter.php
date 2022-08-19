<?php

namespace Pyz\Zed\Planet\Business\Deleter;

use Generated\Shared\Transfer\MoonTransfer;
use Pyz\Zed\Planet\Persistence\PlanetEntityManager;

/**
 * @method PlanetEntityManager getEntityManager()
 */
class MoonDeleter implements MoonDeleterInterface {

    private PlanetEntityManager $ent;

    public function __construct(PlanetEntityManager $ent) {
        $this->ent = $ent;
    }

    public function deleteMoonEntity(MoonTransfer $transfer) : void {
        $this->ent->deleteMoonEntity($transfer);
    }
}
