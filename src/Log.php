<?php
/**
 * User: YL
 * Date: 2020/10/29
 */

namespace Jmhc\Log;

use Throwable;

/**
 * 日志
 * @method static LogManager dir(string $dir)
 * @method static LogManager name(string $filename)
 * @method static LogManager withDateToDir(bool $isBefore = true, string $format = 'Ymd')
 * @method static LogManager withDateToName(bool $isBefore = true, string $format = 'Ymd')
 * @method static LogManager withRequestInfo(bool $with = true)
 * @method static LogManager withMessageLineBreak(bool $with = true)
 * @method static LogManager throwable(Throwable $e, array $context = [])
 * @package Jmhc\Log
 */
class Log extends \Illuminate\Support\Facades\Log
{
    protected static function getFacadeAccessor()
    {
        if (! static::$app->has(LogManager::class)) {
            app()->instance(LogManager::class, new LogManager(static::$app));
        }

        return LogManager::class;
    }
}
