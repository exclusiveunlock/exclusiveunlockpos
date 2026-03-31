<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * 
 * @property int $id
 * @property int $user_id
 * @property int $firmware_id
 * @property string $subject
 * @property string|null $description
 * @property string|null $image_path
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Firmware $firmware
 * @property User $user
 *
 * @package App\Models
 */
class Report extends Model
{
	protected $table = 'reports';

	protected $casts = [
		'user_id' => 'int',
		'firmware_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'firmware_id',
		'subject',
		'description',
		'image_path',
		'status'
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
