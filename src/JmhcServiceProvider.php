<?php
/**
 * User: YL
 * Date: 2020/10/29
 */

namespace Jmhc\Log;

use Illuminate\Support\ServiceProvider;

class JmhcServiceProvider extends ServiceProvider
{
    public function register()
    {
        // 合并配置
        $this->mergeConfig();
    }

    /**
     * 合并配置
     */
    protected function mergeConfig()
    {
        // 合并日志配置
        $this->mergeConfigFrom(
            __DIR__ . '/../config/logging.php',
            'logging.channels.jmhc_log'
        );
    }
}
