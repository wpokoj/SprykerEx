<?php

namespace Pyz\Zed\Planet\Business\Deleter;

use Generated\Shared\Transfer\MoonTransfer;

interface MoonDeleterInterface {

    public function deleteMoonEntity(MoonTransfer $transfer) : void;
}
