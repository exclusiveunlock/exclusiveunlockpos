<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GeneralSetting
 * 
 * @property int $id
 * @property string|null $site_name
 * @property string|null $site_logo
 * @property string|null $site_favicon
 * @property string|null $site_description
 * @property string|null $contact_email
 * @property string|null $contact_phone
 * @property string|null $address
 * @property string|null $facebook_url
 * @property string|null $twitter_url
 * @property string|null $instagram_url
 * @property string|null $youtube_url
 * @property string|null $app_timezone
 * @property string|null $footer_text
 * @property string|null $footer_whatsapp_url
 * @property string|null $footer_hikma_url
 * @property string|null $custom_header_html
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class GeneralSetting extends Model
{
	protected $table = 'general_settings';

	protected $fillable = [
		'site_name',
		'site_logo',
		'site_favicon',
		'site_description',
		'contact_email',
		'contact_phone',
		'address',
		'facebook_url',
		'twitter_url',
		'instagram_url',
		'youtube_url',
		'app_timezone',
		'footer_text',
		'footer_whatsapp_url',
		'footer_hikma_url',
		'custom_header_html'
	];
}
