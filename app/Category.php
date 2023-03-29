<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Blog[] $posts
 * @property-read int|null $posts_count
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Query\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Category withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @property string $name
 * @property int|null $parent_id
 * @property int $level
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $description
 * @property int $display_order
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $childrenCategories
 * @property-read Category|null $parentCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @property string|null $meta_img
 * @property-read int|null $children_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereMetaImg($value)
 * @property int $show_on_home_page
 * @property int $show_on_header
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereShowOnHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereShowOnHomePage($value)
 */
class Category extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    public function posts()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('childrenCategories');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
