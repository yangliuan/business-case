<?php
return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'yunpian', 'aliyun',
        ],
    ],

    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/notify/easy-sms.log',
        ],
        'yunpian' => [
            'api_key' => env('EASYSMS_YUNPIAN_API_KEY',''),
        ],
        'aliyun' => [
            'access_key_id' => env('EASYSMS_ALIYUN_KEY_ID',''),
            'access_key_secret' => env('EASYSMS_ALIYUN_KEY_SECRET',''),
            'sign_name' => env('EASYSMS_ALIYUN_SING_NAME',''),
        ],
        //...
    ],

    //测试验证码，不实际发送
    'no_send_smscode' => env('NO_SEND_SMSCODE', ''),

    //给前端使用的签名
    'sign_key' => env('SMS_SIGN_KEY', ''),

    //HomeSafely
    'safe_mobile' => explode(',',env('EASY_SMS_SAFE_MOBILE','')),

];
