<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute 必须是被认可的.',
    'active_url'           => ':attribute 不是有效的URL.',
    'after'                => ':attribute 必须是 :date 之后的日期.',
    'after_or_equal'       => ':attribute 必须是一个日期之后或等于 :date.',
    'alpha'                => ':attribute may only contain letters.',
    'alpha_dash'           => ':attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => ':attribute may only contain letters and numbers.',
    'array'                => ':attribute 必须是一个数组.',
    'before'               => ':attribute 必须是 :date 之前的日期.',
    'before_or_equal'      => ':attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => ':attribute 必须在 :min 和 :max 之间.',
        'file'    => ':attribute 大小必须在 :min 和 :max 千字节之间.',
        'string'  => ':attribute must be between :min and :max characters.',
        'array'   => ':attribute must have between :min and :max items.',
    ],
    'boolean'              => ':attribute 字段必须是true或false.',
    'confirmed'            => ':attribute 确认不符.',
    'date'                 => ':attribute 不是有效日期.',
    'date_format'          => ':attribute 不匹配格式 :format.',
    'different'            => ':attribute 和 :other 必须不同.',
    'digits'               => ':attribute 必须 :digits 数字.',
    'digits_between'       => ':attribute 必须是 :min 和 :max 的数字.',
    'dimensions'           => ':attribute 图像尺寸无效.',
    'distinct'             => ':attribute 字段具有重复值.',
    'email'                => ':attribute 必须是一个有效的电子邮件地址.',
    'exists'               => '选项 :attribute 无效.',
    'file'                 => ':attribute 必须是一个文件.',
    'filled'               => ':attribute 字段必须有一个值.',
    'gt'                   => [
        'numeric' => ':attribute 必须大于 :value.',
        'file'    => ':attribute 必须大于 :value 千字节.',
        'string'  => ':attribute 必须大于 :value 文字.',
        'array'   => ':attribute must have more than :value items.',
    ],
    'gte'                  => [
        'numeric' => ':attribute 必须大于或等于 :value.',
        'file'    => ':attribute 必须大于或等于 :value 千字节.',
        'string'  => ':attribute 必须大于或等于 :value 文字.',
        'array'   => ':attribute must have :value items or more.',
    ],
    'image'                => ':attribute 必须是一个图片.',
    'in'                   => '选项 :attribute 无效.',
    'in_array'             => ':attribute 字段不存在 :other.',
    'integer'              => ':attribute 必须是整数.',
    'ip'                   => ':attribute 必须是一个有效的IP地址 .',
    'ipv4'                 => ':attribute 必须是一个有效的IPv4地址.',
    'ipv6'                 => ':attribute 必须是一个有效的IPv6地址.',
    'json'                 => ':attribute 必须是有效的JSON字符串.',
    'lt'                   => [
        'numeric' => ':attribute 必须小于 :value.',
        'file'    => ':attribute 必须小于 :value 千字节.',
        'string'  => ':attribute 必须小于 :value 文字.',
        'array'   => ':attribute must have less than :value items.',
    ],
    'lte'                  => [
        'numeric' => ':attribute 必须小于或等于 :value.',
        'file'    => ':attribute 必须小于或等于 :value kilobytes.',
        'string'  => ':attribute 必须小于或等于 :value characters.',
        'array'   => ':attribute must not have more than :value items.',
    ],
    'max'                  => [
        'numeric' => ':attribute may not be greater than :max.',
        'file'    => ':attribute may not be greater than :max kilobytes.',
        'string'  => ':attribute may not be greater than :max characters.',
        'array'   => ':attribute may not have more than :max items.',
    ],
    'mimes'                => ':attribute must be a file of type: :values.',
    'mimetypes'            => ':attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute must be at least :min.',
        'file'    => ':attribute must be at least :min kilobytes.',
        'string'  => ':attribute must be at least :min characters.',
        'array'   => ':attribute must have at least :min items.',
    ],
    'not_in'               => 'selected :attribute is invalid.',
    'not_regex'            => ':attribute format is invalid.',
    'numeric'              => ':attribute must be a number.',
    'present'              => ':attribute field must be present.',
    'regex'                => ':attribute format is invalid.',
    'required'             => ':attribute field is required.',
    'required_if'          => ':attribute field is required when :other is :value.',
    'required_unless'      => ':attribute field is required unless :other is in :values.',
    'required_with'        => ':attribute field is required when :values is present.',
    'required_with_all'    => ':attribute field is required when :values is present.',
    'required_without'     => ':attribute field is required when :values is not present.',
    'required_without_all' => ':attribute field is required when none of :values are present.',
    'same'                 => ':attribute and :other must match.',
    'size'                 => [
        'numeric' => ':attribute must be :size.',
        'file'    => ':attribute must be :size kilobytes.',
        'string'  => ':attribute must be :size characters.',
        'array'   => ':attribute must contain :size items.',
    ],
    'string'               => ':attribute must be a string.',
    'timezone'             => ':attribute must be a valid zone.',
    'unique'               => ':attribute has already been taken.',
    'uploaded'             => ':attribute failed to upload.',
    'url'                  => ':attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
