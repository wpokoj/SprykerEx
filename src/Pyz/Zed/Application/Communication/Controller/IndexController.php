<?php

namespace Pyz\Zed\Application\Communication\Controller;

//use Spryker\Zed\Application\Communication\Controller\IndexController as SprykerIndexController;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @return string
     */
    public function indexAction()
    {
        return ['data' => 'Hello DE'];
    }
}
