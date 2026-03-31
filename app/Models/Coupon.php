<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Coupon
 * 
 * @property int $id
 * @property string $code
 * @property string $discount_type
 * @property float $discount_amount
 * @property Carbon|null $expires_at
 * @property int|null $usage_limit
 * @property int $used_count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Coupon extends Model
{
	protected $table = 'coupons';

	protected $casts = [
		'discount_amount' => 'float',
		'expires_at' => 'datetime',
		'usage_limit' => 'int',
		'used_count' => 'int'
	];

	protected $fillable = [
		'code',
		'discount_type',
		'discount_amount',
		'expires_at',
		'usage_limit',
		'used_count'
	];
}
