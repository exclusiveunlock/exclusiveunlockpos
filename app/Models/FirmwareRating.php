<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FirmwareRating
 * 
 * @property int $id
 * @property int $user_id
 * @property int $firmware_id
 * @property int $rating
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Firmware $firmware
 * @property User $user
 *
 * @package App\Models
 */
class FirmwareRating extends Model
{
	protected $table = 'firmware_ratings';

	protected $casts = [
		'user_id' => 'int',
		'firmware_id' => 'int',
		'rating' => 'int'
	];

	protected $fillable = [
		'user_id',
		'firmware_id',
		'rating'
	];

	public function firmware()
	{
		return $this->belongsTo(Firmware::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
