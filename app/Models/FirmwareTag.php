<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FirmwareTag
 * 
 * @property int $id
 * @property int $firmware_id
 * @property int $tag_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Firmware $firmware
 * @property Tag $tag
 *
 * @package App\Models
 */
class FirmwareTag extends Model
{
	protected $table = 'firmware_tag';

	protected $casts = [
		'firmware_id' => 'int',
		'tag_id' => 'int'
	];

	protected $fillable = [
		'firmware_id',
		'tag_id'
	];

	public function firmware()
	{
		return $this->belongsTo(Firmware::class);
	}

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
