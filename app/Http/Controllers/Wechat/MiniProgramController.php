<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EasyWeChat\Factory;
use App\Models\User;

class MiniProgramController extends Controller
{
    /**
     * 小程序登录并获取用户信息
     *
     * @param Request $request
     * @return json
     */
    public function login(Request $request)
    {
        $request->validate([
            'code' => 'bail|required|string',
            'encryptedData' => 'bail|required|string',
            'iv' => 'bail|required|string',
        ]);

        $config = config('wechat.mini_program.default');
        $app = Factory::miniProgram($config);

        $res_session = $app->auth->session($request->code);

        if (isset($res_session['errcode']) && $res_session['errcode']) {
            throw ValidationException::withMessages(['code' => $res_session['errcode'] . $res_session['errmsg']]);
        }

        try {
            $decryptedData = $app->encryptor->decryptData($res_session['session_key'], $request->iv, $request->encryptedData);
        } catch (\Exception $e) {
            throw ValidationException::withMessages(['encryptedData' => $e->getMessage()]);
        }

        $user_info = [
            'name' => $decryptedData['nickName'],
            'avatar' => $decryptedData['avatarUrl'],
            'sex' => $decryptedData['gender'],
            'province' => $decryptedData['province'],
            'city' => $decryptedData['city'],
            'area' => $decryptedData['country'],
        ];
    }

    public function bindMobile(Request $request)
    {
        $request->validate([
            'code' => 'bail|required|string',
            'encryptedData' => 'bail|required|string',
            'iv' => 'bail|required|string',
        ]);

        $config = config('wechat.mini_program.default');
        $app = Factory::miniProgram($config);
        //获取最新的session_key
        $res_session = $app->auth->session($request->code);

        if (isset($res_session['errcode']) && $res_session['errcode']) {
            throw ValidationException::withMessages(['code' => $res_session['errcode'] . $res_session['errmsg']]);
        }

        //解密用户手机号
        try {
            //因为session_key会过期，是由微信服务器控制的，所以每次需要使用最新的session_key解密，
            $decryptedData = $app->encryptor->decryptData($res_session['session_key'], $request->iv, $request->encryptedData);
        } catch (\Throwable $th) {
            throw ValidationException::withMessages(['encryptedData' => $th->getMessage()]);
        }

        if (isset($decryptedData['purePhoneNumber']) && $decryptedData['purePhoneNumber']) {
            //场景一：用户已经登录，绑定手机号
            $request->user('api')->update([
                'mobile'=>$decryptedData['purePhoneNumber']
            ]);
            //场景二：使用手机号作为唯一标识,注册或登陆
            User::firstOrCreate(['mobile'=>$decryptedData['purePhoneNumber']]);
        }

        return response()->json(['mobile'=>$decryptedData['purePhoneNumber']]);
    }

    /**
     * 登出
     *
     * @param Request $request
     * @return json
     */
    public function logout(Request $request)
    {
        $request->user('api')->tokens()->where('name', 'api')->delete();

        return response()->json();
    }
}
