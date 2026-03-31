<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 * 
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $symbol
 * @property float $exchange_rate
 * @property bool $is_default
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|PaymentGateway[] $payment_gateways
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Currency extends Model
{
	protected $table = 'currencies';

	protected $casts = [
		'exchange_rate' => 'float',
		'is_default' => 'bool',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'code',
		'symbol',
		'exchange_rate',
		'is_default',
		'is_active'
	];

	public function payment_gateways()
	{
		return $this->hasMany(PaymentGateway::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
