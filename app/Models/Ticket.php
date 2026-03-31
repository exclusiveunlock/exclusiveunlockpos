<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * 
 * @property int $id
 * @property int $user_id
 * @property string $subject
 * @property string $message
 * @property string $status
 * @property string $priority
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|TicketReply[] $ticket_replies
 *
 * @package App\Models
 */
class Ticket extends Model
{
	protected $table = 'tickets';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'subject',
		'message',
		'status',
		'priority'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function ticket_replies()
	{
		return $this->hasMany(TicketReply::class);
	}
}
