<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Announcement
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property Carbon|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Announcement extends Model
{
	protected $table = 'announcements';

	protected $casts = [
		'published_at' => 'datetime'
	];

	protected $fillable = [
		'title',
		'content',
		'published_at'
	];
}
