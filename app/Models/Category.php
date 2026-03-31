<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $image
 * @property string|null $icon
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Category extends Model
{
	use SoftDeletes;
	protected $table = 'categories';

	protected $casts = [
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'description',
		'image',
		'icon',
		'status'
	];

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
