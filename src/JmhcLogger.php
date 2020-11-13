<?php
/**
 * User: YL
 * Date: 2020/10/29
 */

namespace Jmhc\Log;

use Illuminate\Log\ParsesLogConfiguration;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\FormattableHandlerInterface;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger as Monolog;

/**
 * 日志
 * @package Jmhc\Log
 */
class JmhcLogger
{
    use ParsesLogConfiguration;

    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * Prepare the handler for usage by Monolog.
     *
     * @param  \Monolog\Handler\HandlerInterface  $handler
     * @param  array  $config
     * @return \Monolog\Handler\HandlerInterface
     */
    protected function prepareHandler(HandlerInterface $handler, array $config = [])
    {
        $isHandlerFormattable = false;

        if (Monolog::API === 1) {
            $isHandlerFormattable = true;
        } elseif (Monolog::API === 2 && $handler instanceof FormattableHandlerInterface) {
            $isHandlerFormattable = true;
        }

        if ($isHandlerFormattable && ! isset($config['formatter'])) {
            $handler->setFormatter($this->formatter());
        } elseif ($isHandlerFormattable && $config['formatter'] !== 'default') {
            $handler->setFormatter(app($config['formatter'], $config['formatter_with'] ?? []));
        }

        return $handler;
    }

    /**
     * Get a Monolog formatter instance.
     *
     * @return \Monolog\Formatter\FormatterInterface
     */
    protected function formatter()
    {
        return tap(new LineFormatter(null, $this->dateFormat, true, true), function ($formatter) {
            $formatter->includeStacktraces();
        });
    }

    /**
     * {@inheritDoc}
     */
    protected function getFallbackChannelName()
    {
        return app()->bound('env') ? app()->environment() : 'production';
    }

    public function __invoke(array $config)
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new StreamHandler(
                $config['path'],
                $config['debug'],
                $config['with_request_info'],
                $config['max_size'],
                $config['max_files'],
                $this->level($config),
                $config['bubble'],
                $config['permission'],
                $config['locking']
            ), $config),
        ]);
    }
}
