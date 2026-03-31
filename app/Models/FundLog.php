<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FundLog
 * 
 * @property int $id
 * @property int $user_id
 * @property float $amount
 * @property int|null $payment_gateway_id
 * @property string|null $description
 * @property string|null $type
 * @property int|null $package_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Package|null $package
 * @property PaymentGateway|null $payment_gateway
 * @property User $user
 *
 * @package App\Models
 */
class FundLog extends Model
{
	protected $table = 'fund_logs';

	protected $casts = [
		'user_id' => 'int',
		'amount' => 'float',
		'payment_gateway_id' => 'int',
		'package_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'amount',
		'payment_gateway_id',
		'description',
		'type',
		'package_id'
	];

	public function package()
	{
		return $this->belongsTo(Package::class);
	}

	public function payment_gateway()
	{
		return $this->belongsTo(PaymentGateway::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
