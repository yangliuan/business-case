# user third party
php artisan make:scaffold UserThirdPartyLogin --schema="user_id:integer(false,true):default(0):comment('用户id'),thirdparty:string(20):default(''):comment('第三方授权平台'),identifier:string(64):default(''):comment('用户在第三方平台唯一标识'),tnickname:string(20):default(''):comment('用户在第三方平台的昵称'),tavatar:string(255):default(''):comment('用户在第三方平台的头像')" --comment="第三方用户登录绑定表"

# excel demo
php artisan make:scaffold ExcelDemo --schema="str_column:string(255):default(''):comment('字符串字段'),int_column:integer(false,true):default(0):comment('整数字段'),float_column:decimal(8,2,false):default(0):comment('浮点数字段'),pic_column:string(255):default(''):comment('图片字段'),text_column:text:nullable:comment('文本字段')" --comment="excel demo"

# picture demo
php artisan make:scaffold PictureDemo --schema="disk:string(20):default(''):comment('磁盘'),path:string(255):default(''):comment('存储路径')" --comment="picture demo"

# image demo
php artisan make:scaffold ImageDemo --schema="path:string(255):default(''):comment('存储路径'),path_group:text:nullable:comment('存储路径组')" --comment="image demo"

# device 设备表
php artisan make:scaffold Device --schema="mac_address:string(17):default(''):comment('设备mac地址'),alias:string(20):default(''):comment('设备别名')" --comment="设备表"

# asset 资源表
php artisan make:scaffold Asset --schema="asset_type:enum(['img','video','audio']):default('img'):comment('资源类型'),path:string(255):default(''):comment('资源文件路径')" --comment="资源表"

# device_asset 设备资源关联表
php artisan make:scaffold DeviceAsset --schema="dev_id:integer:default(0):comment('设备id'),asset_id:integer:default(0):comment('资源id'),sort:integer:default(0):comment('排序值')" --comment="设备资源关联表"

# control_instruction 控制指令表
php artisan make:scaffold ControlInstruction --schema="dev_id:integer:default(0):comment('设备id'),action_type:string(50):default(''):comment('动作类型move移动指令/play_video播放视频指令/play_audio播放音频/play_related_video播放画中画视频操作/resize_related_video切换画中画视频的大小和位置/show_related_video画中画是否显示'),action:string(30):default(''):comment('移动指令left/right/up/down/jump-id/reset|播放音视频指令:play/stop/resume/replay|画中画位置top/bottom/left/right/middle|画中画显示show/hidden')" --comment="控制指令表"
