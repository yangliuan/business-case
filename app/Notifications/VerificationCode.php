<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Leonis\Notifications\EasySms\Channels\EasySmsChannel;
use Leonis\Notifications\EasySms\Messages\EasySmsMessage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class VerificationCode extends Notification
{
    use Queueable;

    const KEY_TEMPLATE = 'verify_code_of_%s';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [EasySmsChannel::class];
    }

    public function toEasySms($notifiable)
    {
        return (new EasySmsMessage)
            ->setContent("您的验证码为：6328，请勿泄露于他人！")
            ->setTemplate('SMS_001')
            ->setData(['code' => 6379]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * 创建并存储验证码
     *
     * @param string $phone
     * @param string $type 类型 user用户,member联盟会员
     * @return int
     */
    public static function create($phone, $type = 'user')
    {
        $code = mt_rand(1000, 9999);
        $log = Log::channel('smscode');
        $log->info("生成验证码:{$phone}:{$code}");
        $key = $type.'_'.sprintf(self::KEY_TEMPLATE, $phone);
        Cache::put($key, $code, 300);
        $log->info('验证码:'.$code.'发送成功'."\r\n");

        return $code;
    }

    /**
     * 检查手机号与验证码是否匹配.
     *
     * @param string $phone
     * @param int    $code
     * @param string $type 类型 user用户,member联盟会员
     *
     * @return bool
     */
    public static function validate($phone, $code, $type = 'user')
    {
        if (empty($phone) || empty($code)) {
            return false;
        }

        if (config('app.env') !== 'production' && config('easysms.no_send_smscode') === $code) {
            return true;
        }

        $key = $type.'_'.sprintf(self::KEY_TEMPLATE, $phone);
        $cachedCode = Cache::get($key);
        $log = Log::channel('smscode');
        $log->info('cached verify code', ['key' => $key, 'cached' => $cachedCode, 'input' => $code]);
        $log->info("\r\n");

        return strval($cachedCode) === strval($code);
    }
}
