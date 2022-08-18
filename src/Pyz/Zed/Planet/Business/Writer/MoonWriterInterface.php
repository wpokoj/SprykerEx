<?php

namespace Pyz\Zed\Planet\Business\Writer;

use Generated\Shared\Transfer\MoonTransfer;

interface MoonWriterInterface {
    public function saveMoon(MoonTransfer $moonTransfer) : MoonTransfer;
}
