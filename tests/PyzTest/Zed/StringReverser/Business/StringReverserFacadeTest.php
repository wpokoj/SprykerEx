<?php

namespace PyzTest\Zed\StringReverser\Business;

use Codeception\Test\Unit;
use Generated\Shared\DataBuilder\StringReverserBuilder;
use Pyz\Zed\StringReverser\Business\StringReverserFacade;
use PyzTest\Zed\StringReverser\StringReverserBusinessTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group StringReverser
 * @group Business
 * @group Facade
 * @group StringReverserFacadeTest
 * Add your own group annotations below this line
 *
 * @method StringReverserFacade getFacade()
 */
class StringReverserFacadeTest extends Unit {

    /**
     * @var \PyzTest\Zed\StringReverser\StringReverserBusinessTester
     */
    protected StringReverserBusinessTester $tester;

    /**
    +     * @return void
    +     */
    public function testStringIsReversedCorrectly(): void
    {
        $this->assertTrue(false, 'chcę oblać ten test');
        return;

        // Arrange
        $stringReverserTransfer = (new StringReverserBuilder([
            'originalString' => 'Hello Spryker!'
        ]))->build();

        // Act
        $stringReverserResultTransfer =
            $this->tester->getFacade()->reverseString($stringReverserTransfer);
        //$stringReverserResultTransfer = $stringReverserTransfer;
        //$stringReverserResultTransfer->setReversedString(strrev($stringReverserTransfer->getOriginalString()));

        // Assert
        $this->assertSame(
            '!rekyrpS olleH',
            $stringReverserResultTransfer->getReversedString()
        );
    }
}
