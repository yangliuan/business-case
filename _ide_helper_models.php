<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ExcelDemo
 *
 * @property int $id
 * @property string $str_column 字符串字段
 * @property int $int_column 整数字段
 * @property string $float_column 浮点数字段
 * @property string $pic_column 图片字段
 * @property string|null $text_column 文本字段
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel recent()
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo whereFloatColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo whereIntColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo wherePicColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo whereStrColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo whereTextColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExcelDemo whereUpdatedAt($value)
 */
	class ExcelDemo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImageDemo
 *
 * @property int $id
 * @property string $path 存储路径
 * @property mixed|null $path_group 存储路径组
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ImageDemo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageDemo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageDemo query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel recent()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageDemo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageDemo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageDemo wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageDemo wherePathGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageDemo whereUpdatedAt($value)
 */
	class ImageDemo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PictureDemo
 *
 * @property int $id
 * @property string $disk 磁盘
 * @property string $path 存储路径
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PictureDemo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PictureDemo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PictureDemo query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel recent()
 * @method static \Illuminate\Database\Eloquent\Builder|PictureDemo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PictureDemo whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PictureDemo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PictureDemo wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PictureDemo whereUpdatedAt($value)
 */
	class PictureDemo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserThirdPartyLogin
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $thirdparty 第三方授权平台
 * @property string $identifier 用户在第三方平台唯一标识
 * @property string $tnickname 用户在第三方平台的昵称
 * @property string $tavatar 用户在第三方平台的头像
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel recent()
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin whereTavatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin whereThirdparty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin whereTnickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserThirdPartyLogin whereUserId($value)
 */
	class UserThirdPartyLogin extends \Eloquent {}
}

