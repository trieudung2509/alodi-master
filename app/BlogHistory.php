<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\BlogHistory
 *
 * @property int $id
 * @property int $blog_id
 * @property string $title
 * @property string $sub_title
 * @property string $slug
 * @property string|null $version
 * @property string|null $small_img
 * @property string|null $meta_img
 * @property string|null $meta_keywords
 * @property string|null $meta_title
 * @property string|null $source_url
 * @property string|null $short_description
 * @property string|null $meta_description
 * @property string|null $description
 * @property int $status
 * @property int|null $priority_type
 * @property string $replaced_at
 * @property int $editor_id
 * @property-read \App\Blog $blog
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereEditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereMetaImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory wherePriorityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereReplacedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereSmallImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereSourceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereVersion($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereStatus($value)
 * @property string|null $category_names
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereCategoryNames($value)
 * @property int $featured
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereFeatured($value)
 * @property int|null $description_word_count
 * @method static \Illuminate\Database\Eloquent\Builder|BlogHistory whereDescriptionWordCount($value)
 */
class BlogHistory extends Model
{
    use HasFactory;

    protected $table = 'blog_histories';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
