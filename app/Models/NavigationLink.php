<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NavigationLink
 * 
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string $url
 * @property int $order
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class NavigationLink extends Model
{
	protected $table = 'navigation_links';

	protected $casts = [
		'order' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'label',
		'url',
		'order',
		'is_active'
	];
}
