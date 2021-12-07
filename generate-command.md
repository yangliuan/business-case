# user third party
php artisan make:scaffold UserThirdPartyLogin --schema="user_id:integer(false,true):default(0):comment('用户id'),thirdparty:string(20):default(''):comment('第三方授权平台'),identifier:string(64):default(''):comment('用户在第三方平台唯一标识'),tnickname:string(20):default(''):comment('用户在第三方平台的昵称'),tavatar:string(255):default(''):comment('用户在第三方平台的头像')" --comment="第三方用户登录绑定表"

# excel demo
php artisan make:scaffold ExcelDemo --schema="str_column:string(255):default(''):comment('字符串字段'),int_column:integer(false,true):default(0):comment('整数字段'),float_column:decimal(8,2,false):default(0):comment('浮点数字段'),pic_column:string(255):default(''):comment('图片字段'),text_column:text:nullable:comment('文本字段')" --comment="excel demo"

# picture demo
php artisan make:scaffold PictureDemo --schema="disk:string(20):default(''):comment('磁盘'),path:string(255):default(''):comment('存储路径')" --comment="picture demo"
