<?php
/**
 * User: YL
 * Date: 2020/10/29
 */

namespace Jmhc\Log;

/**
 * 添加日期
 * @package Jmhc\Log
 */
class WithDate
{
    /**
     * @var string
     */
    public $format;

    /**
     * @var bool
     */
    public $isBefore;

    public function __construct(string $format = 'Ymd', bool $isBefore = true)
    {
        $this->format = $format;
        $this->isBefore = $isBefore;
    }

    /**
     * 获取参数
     * @param string $name
     * @return array
     */
    public function getParams(string $name)
    {
        // 时间
        $date = date($this->format);

        // 参数
        $params = [$name, $date];
        // 时间在前
        if ($this->isBefore) {
            $params = [$date, $name];
        }

        return $params;
    }
}
