<?php

namespace Pyz\Zed\StringReverser\Business\Reverser;

use Generated\Shared\Transfer\HelloSprykerTransfer;
use Generated\Shared\Transfer\StringReverserTransfer;

interface HelloSprykerReverserInterface {

    public function reverse(StringReverserTransfer $trans): StringReverserTransfer;
}
