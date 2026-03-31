<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Slider
 * 
 * @property int $id
 * @property string $image_path
 * @property string|null $link
 * @property int $order
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Slider extends Model
{
	protected $table = 'sliders';

	protected $casts = [
		'order' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'image_path',
		'link',
		'order',
		'is_active'
	];
}
