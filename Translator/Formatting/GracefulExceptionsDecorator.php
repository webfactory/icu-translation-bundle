<?php

namespace Webfactory\IcuTranslationBundle\Translator\Formatting;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Webfactory\IcuTranslationBundle\Translator\Formatting\Exception\FormattingException;

/**
 * Catches exceptions generated in the decorated formatter to log them and to returns a string gracefully.
 *
 * @final by default.
 */
final class GracefulExceptionsDecorator extends AbstractFormatterDecorator
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Creates a decorator for the provided formatter.
     *
     * @param \Webfactory\IcuTranslationBundle\Translator\Formatting\FormatterInterface $innerFormatter
     * @param LoggerInterface $logger
     */
    public function __construct(FormatterInterface $innerFormatter, LoggerInterface $logger = null)
    {
        $this->innerFormatter = $innerFormatter;
        $this->logger = ($logger !== null) ? $logger : new NullLogger();
    }

    /**
     * Formats the provided message.
     *
     * @param string $locale
     * @param string $message
     * @param array(string=>mixed) $parameters
     * @return string The formatted message.
     */
    public function format($locale, $message, array $parameters)
    {
        try {
            return parent::format($locale, $message, $parameters);
        } catch (FormattingException $e) {
            $this->logger->error($e);
            return ' (message formatting error)';
        }
    }
}