<?php

namespace Pyz\Zed\HelloSpryker\Business;

use Pyz\Zed\HelloSpryker\Business\Reverser\StringReverser;
use Pyz\Zed\HelloSpryker\Business\Reverser\StringReverserInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Pyz\Zed\HelloSpryker\Business\Reader\StringReader;
use Pyz\Zed\HelloSpryker\Business\Reader\StringReaderInterface;
use Pyz\Zed\HelloSpryker\Business\Writer\StringWriter;
use Pyz\Zed\HelloSpryker\Business\Writer\StringWriterInterface;



/**
* @method \Pyz\Zed\HelloSpryker\Persistence\HelloSprykerEntityManagerInterface getEntityManager()
* @method \Pyz\Zed\HelloSpryker\Persistence\HelloSprykerRepositoryInterface getRepository()
*/
class HelloSprykerBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\HelloSpryker\Business\Reverser\StringReverserInterface
     */
    public function createStringReverser(): StringReverserInterface
    {
        return new StringReverser();
    }

    /**
     * @return \Pyz\Zed\HelloSpryker\Business\Reader\StringReaderInterface
     */
    public function createStringReader(): StringReaderInterface
    {
        return new StringReader($this->getRepository());
    }

    /**
     * @return \Pyz\Zed\HelloSpryker\Business\Writer\StringWriterInterface
     */
    public function createStringWriter(): StringWriterInterface
    {
        return new StringWriter($this->getEntityManager());
    }
}
