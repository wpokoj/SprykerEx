<?php

namespace Pyz\Zed\StringReverser\Business;

use Pyz\Zed\StringReverser\Business\Reverser\HelloSprykerReverser;
use Pyz\Zed\StringReverser\Business\Reverser\HelloSprykerReverserInterface;

class StringReverserFactory {

    public function getReverser(): HelloSprykerReverserInterface {

        return new HelloSprykerReverser();
    }
}
