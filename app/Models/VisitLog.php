<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VisitLog
 * 
 * @property int $id
 * @property string $ip
 * @property string $url
 * @property string|null $referer
 * @property string|null $user_agent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class VisitLog extends Model
{
	protected $table = 'visit_logs';

	protected $fillable = [
		'ip',
		'url',
		'referer',
		'user_agent'
	];
}
