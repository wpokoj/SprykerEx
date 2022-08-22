<?php

namespace Pyz\Zed\StringReverser\Business;

use Generated\Shared\Transfer\HelloSprykerTransfer;
use Generated\Shared\Transfer\StringReverserTransfer;

interface StringReverserFacadeInterface {

    public function reverseString(StringReverserTransfer $trans): StringReverserTransfer;
}
