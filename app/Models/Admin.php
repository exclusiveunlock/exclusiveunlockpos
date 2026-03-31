<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string $password
 * @property string|null $pin
 * @property string|null $google2fa_secret
 * @property bool $google2fa_enabled
 * @property string|null $permissions
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Admin extends Model
{
	protected $table = 'admins';

	protected $casts = [
		'google2fa_enabled' => 'bool'
	];

	protected $hidden = [
		'password',
		'google2fa_secret',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'role',
		'password',
		'pin',
		'google2fa_secret',
		'google2fa_enabled',
		'permissions',
		'remember_token'
	];
}
