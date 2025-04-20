<?php

namespace Otus\Diag;

use Bitrix\Main\Diag\ExceptionHandlerFormatter;
use Psr\Log;
/**
 *
 */

class FileExceptionHandlerLogCustom extends \Bitrix\Main\Diag\FileExceptionHandlerLog
{
    /**
     * @param $exception
     * @param $logType
     * @return void
     */
    public function write($exception, $logType)
    {
        $text = ExceptionHandlerFormatter::format($exception, false, $this->level);

        $context = [
            'type' => static::logTypeToString($logType),
        ];

        $logLevel = static::logTypeToLevel($logType);

        $message = "Otus - {date} - Host: {host} - {type} - {$text}\n";

        $this->logger->log($logLevel, $message, $context);
    }
}