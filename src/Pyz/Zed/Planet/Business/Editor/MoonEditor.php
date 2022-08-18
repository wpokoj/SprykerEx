<?php

namespace Pyz\Zed\Planet\Business\Editor;

use Generated\Shared\Transfer\MoonTransfer;
use Pyz\Zed\Planet\Business\Writer\MoonWriterInterface;
use Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface;

class MoonEditor implements MoonEditorInterface {

    protected PlanetEntityManagerInterface $ent;

    public function __construct(PlanetEntityManagerInterface $ent) {
        $this->ent = $ent;
    }

    public function editMoonEntity(MoonTransfer $transfer): MoonTransfer {
        return $this->ent->editMoonEntity($transfer);
    }
}
