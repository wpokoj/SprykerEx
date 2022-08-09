<?php

namespace Pyz\Zed\Application\Communication\Controller;

use Spryker\Zed\Application\Communication\Controller\IndexController as SprykerIndexController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends SprykerIndexController
{
    /**
     * @return string
     */
    public function indexAction() : Response
    {
        return new Response('Hello DE Store!');
    }
}
