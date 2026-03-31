<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommentSubscription
 * 
 * @property int $id
 * @property string $subscribable_type
 * @property int $subscribable_id
 * @property string $subscriber_type
 * @property int $subscriber_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CommentSubscription extends Model
{
	protected $table = 'comment_subscriptions';

	protected $casts = [
		'subscribable_id' => 'int',
		'subscriber_id' => 'int'
	];

	protected $fillable = [
		'subscribable_type',
		'subscribable_id',
		'subscriber_type',
		'subscriber_id'
	];
}
