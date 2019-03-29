<?php

namespace Webfactory\IcuTranslationBundle\Tests\Translator\Formatting;

/**
 * Tests the abstract formatter decorator.
 */
class AbstractFormatterDecoratorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * System under test.
     *
     * @var \Webfactory\IcuTranslationBundle\Translator\Formatting\AbstractFormatterDecorator
     */
    protected $decorator = null;

    /**
     * The simulated inner formatter.
     *
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $innerFormatter = null;

    /**
     * Initializes the test environment.
     */
    protected function setUp()
    {
        parent::setUp();
        $formatterInterface   = 'Webfactory\IcuTranslationBundle\Translator\Formatting\FormatterInterface';
        $this->innerFormatter = $this->createMock($formatterInterface);
        $decoratorClass  = 'Webfactory\IcuTranslationBundle\Translator\Formatting\AbstractFormatterDecorator';
        $this->decorator = $this->getMockForAbstractClass($decoratorClass, array($this->innerFormatter));
    }

    /**
     * Cleans up the test environment.
     */
    protected function tearDown()
    {
        $this->decorator      = null;
        $this->innerFormatter = null;
        parent::tearDown();
    }

    /**
     * Checks if the decorator implements the formatter interface.
     */
    public function testImplementsInterface()
    {
        $formatterInterface = 'Webfactory\IcuTranslationBundle\Translator\Formatting\FormatterInterface';
        $this->assertInstanceOf($formatterInterface, $this->decorator);
    }

    /**
     * Checks if the decorator delegates format() calls to the inner formatter.
     */
    public function testFormatDelegatesToInnerFormatter()
    {
        $this->innerFormatter->expects($this->once())->method('format');

        $this->decorator->format('de_DE', 'test message', array());
    }

}
