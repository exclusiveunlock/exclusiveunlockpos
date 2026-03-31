<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * 
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property string|null $footer_text
 * @property string|null $footer_quick_links_html
 * @property string|null $footer_support_links_html
 * @property string|null $footer_facebook_url
 * @property string|null $footer_whatsapp_url
 * @property string|null $footer_youtube_url
 * @property string|null $footer_instagram_url
 * @property string|null $footer_hikma_url
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $seo_keywords
 * @property string|null $google_analytics_id
 * @property string|null $version
 * @property string|null $update
 * @property string|null $update_log
 * @property string|null $api_key
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Setting extends Model
{
	protected $table = 'settings';

	protected $fillable = [
		'key',
		'value',
		'footer_text',
		'footer_quick_links_html',
		'footer_support_links_html',
		'footer_facebook_url',
		'footer_whatsapp_url',
		'footer_youtube_url',
		'footer_instagram_url',
		'footer_hikma_url',
		'seo_title',
		'seo_description',
		'seo_keywords',
		'google_analytics_id',
		'version',
		'update',
		'update_log',
		'api_key'
	];
}
