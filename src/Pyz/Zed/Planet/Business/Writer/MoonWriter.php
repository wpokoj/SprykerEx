<?php

namespace Pyz\Zed\Planet\Business\Writer;

use Generated\Shared\Transfer\MoonTransfer;
use Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface;

class MoonWriter implements MoonWriterInterface {

    private PlanetEntityManagerInterface $ent;

    public function __construct(PlanetEntityManagerInterface $ent) {
        $this->ent = $ent;
    }

    public function saveMoon(MoonTransfer $moonTransfer) : MoonTransfer {

        return $this->ent->saveMoonEntity($moonTransfer);
    }

}
