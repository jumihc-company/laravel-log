<?php
/**
 * User: YL
 * Date: 2020/10/29
 */

namespace Jmhc\Log;

use DateTimeZone;

/**
 * 日志通道
 * @package Jmhc\Log
 */
class Logger extends \Monolog\Logger
{
    /**
     * @var bool
     */
    protected $withMessageLineBreak;

    public function __construct(bool $withMessageLineBreak, string $name, array $handlers = [], array $processors = [], ?DateTimeZone $timezone = null)
    {
        $this->withMessageLineBreak = $withMessageLineBreak;

        parent::__construct($name, $handlers, $processors, $timezone);
    }

    /**
     * {@inheritDoc}
     */
    public function addRecord(int $level, string $message, array $context = []): bool
    {
        // 添加消息换行
        if ($this->withMessageLineBreak) {
            $message = "\n" . $message;
        }

        return parent::addRecord($level, $message, $context);
    }
}
