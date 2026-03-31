<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommentReaction
 * 
 * @property int $id
 * @property int $comment_id
 * @property string $reactor_type
 * @property int $reactor_id
 * @property string $reaction
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Comment $comment
 *
 * @package App\Models
 */
class CommentReaction extends Model
{
	protected $table = 'comment_reactions';

	protected $casts = [
		'comment_id' => 'int',
		'reactor_id' => 'int'
	];

	protected $fillable = [
		'comment_id',
		'reactor_type',
		'reactor_id',
		'reaction'
	];

	public function comment()
	{
		return $this->belongsTo(Comment::class);
	}
}
