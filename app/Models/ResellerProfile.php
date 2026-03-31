<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ResellerProfile
 * 
 * @property int $id
 * @property int $user_id
 * @property string|null $profile_text
 * @property string|null $social_links
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class ResellerProfile extends Model
{
	protected $table = 'reseller_profiles';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'profile_text',
		'social_links'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
