<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MailTemplate
 * 
 * @property int $id
 * @property string $name
 * @property string $subject
 * @property string $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MailTemplate extends Model
{
	protected $table = 'mail_templates';

	protected $fillable = [
		'name',
		'subject',
		'body'
	];
}
