<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | @copyright (c) 原点 All rights reserved.
// +----------------------------------------------------------------------
// | Author: 原点 <467490186@qq.com>
// +----------------------------------------------------------------------
// | Date: 2024/6/7
// +----------------------------------------------------------------------

declare (strict_types=1);

namespace yuandian\attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DateFormat implements ValidateAttribute
{
    public function __construct(public string $rule, public string $message = '')
    {
        if (empty($message)) {
            $this->message = "The date format does not conform to the {$this->rule} format";
        }
    }

    public function validate(mixed $value): bool
    {
        $info = date_parse_from_format($this->rule, $value);
        return 0 == $info['warning_count'] && 0 == $info['error_count'];
    }
}