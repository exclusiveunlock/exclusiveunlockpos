<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserLoginIp
 * 
 * @property int $id
 * @property int $user_id
 * @property string $ip_address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserLoginIp extends Model
{
	protected $table = 'user_login_ips';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'ip_address'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
