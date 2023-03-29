<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

/**
 * App\Page
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PageTranslation[] $page_translations
 * @property-read int|null $page_translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $content
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $keywords
 * @property string|null $meta_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @property string|null $system_name
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSystemName($value)
 */
class Page extends Model
{
    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $page_translation = $this->hasMany(PageTranslation::class)->where('lang', $lang)->first();
        return $page_translation != null ? $page_translation->$field : $this->$field;
    }

    public function page_translations()
    {
        return $this->hasMany(PageTranslation::class);
    }
}
