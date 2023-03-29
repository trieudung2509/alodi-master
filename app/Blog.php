<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Blog
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BlogHistory[] $blogHistories
 * @property-read int|null $blog_histories_count
 * @property-read \App\User $author
 * @method static \Database\Factories\BlogFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Query\Builder|Blog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Query\Builder|Blog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Blog withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
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
 * @property string $published_date
 * @property int $status
 * @property string $display_date
 * @property int|null $priority_type
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDisplayDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog wherePriorityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog wherePublishedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSmallImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSourceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereVersion($value)
 * @property int|null $editor_id
 * @property-read \App\User|null $editor
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereEditorId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read int|null $categories_count
 * @property int $featured
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereFeatured($value)
 * @property int|null $description_word_count
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDescriptionWordCount($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Term[] $terms
 * @property-read int|null $terms_count
 */
class Blog extends Model
{
    use SoftDeletes, HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function blogHistories()
    {
        return $this->hasMany(BlogHistory::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function terms() {
        return $this->belongsToMany(Term::class);
    }
}
