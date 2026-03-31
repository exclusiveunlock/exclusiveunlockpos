<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DownloadLog
 * 
 * @property int $id
 * @property int $user_id
 * @property int $firmware_id
 * @property int $bandwidth_used
 * @property string $ip_address
 * @property Carbon $download_timestamp
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Firmware $firmware
 * @property User $user
 *
 * @package App\Models
 */
class DownloadLog extends Model
{
	protected $table = 'download_logs';

	protected $casts = [
		'user_id' => 'int',
		'firmware_id' => 'int',
		'bandwidth_used' => 'int',
		'download_timestamp' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'firmware_id',
		'bandwidth_used',
		'ip_address',
		'download_timestamp'
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
