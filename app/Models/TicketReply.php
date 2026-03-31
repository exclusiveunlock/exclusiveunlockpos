<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketReply
 * 
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property string $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Ticket $ticket
 * @property User $user
 *
 * @package App\Models
 */
class TicketReply extends Model
{
	protected $table = 'ticket_replies';

	protected $casts = [
		'ticket_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'ticket_id',
		'user_id',
		'message'
	];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
