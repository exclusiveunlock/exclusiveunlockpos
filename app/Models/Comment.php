<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * 
 * @property int $id
 * @property string $author_type
 * @property int $author_id
 * @property string $commentable_type
 * @property int $commentable_id
 * @property string $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|CommentReaction[] $comment_reactions
 *
 * @package App\Models
 */
class Comment extends Model
{
	protected $table = 'comments';

	protected $casts = [
		'author_id' => 'int',
		'commentable_id' => 'int'
	];

	protected $fillable = [
		'author_type',
		'author_id',
		'commentable_type',
		'commentable_id',
		'body'
	];

	public function comment_reactions()
	{
		return $this->hasMany(CommentReaction::class);
	}
}
