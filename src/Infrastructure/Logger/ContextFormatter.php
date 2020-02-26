<?php

namespace App\Infrastructure\Logger;

/**
 * Class ContextFormatter
 * @package App\Infrastructure\Logger
 * @author Jean-Yves CAMIER <jycamier@clever-age.com>
 */
class ContextFormatter
{
    public function __invoke($level, $message, $context)
    {
        if (false !== strpos($message, '{')) {
            $replacements = [];
            foreach ($context as $key => $val) {
                if (null === $val || is_scalar($val) || (\is_object($val) && method_exists($val, '__toString'))) {
                    $replacements["{{$key}}"] = $val;
                } elseif ($val instanceof \DateTimeInterface) {
                    $replacements["{{$key}}"] = $val->format(\DateTime::RFC3339);
                } elseif (\is_object($val)) {
                    $replacements["{{$key}}"] = '[object '.\get_class($val).']';
                } else {
                    $replacements["{{$key}}"] = '['.\gettype($val).']';
                }
            }

            $message = strtr($message, $replacements);
        }

        return sprintf('%s [%s] %s %s', date(\DateTime::RFC3339), $level, $message, json_encode($context)).\PHP_EOL;
    }
}
