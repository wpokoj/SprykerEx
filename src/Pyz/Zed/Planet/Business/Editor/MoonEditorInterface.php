<?php

namespace Pyz\Zed\Planet\Business\Editor;

use Generated\Shared\Transfer\MoonTransfer;

interface MoonEditorInterface {

    public function editMoonEntity(MoonTransfer $transfer) : MoonTransfer;
}
