<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Taxonomy
 *
 * @property string|null $description
 * @property string $slug
 * @property int $is_hierarchical
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy newQuery()
 * @method static \Illuminate\Database\Query\Builder|Taxonomy onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereIsHierarchical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereTaxonomyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Taxonomy withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Taxonomy withoutTrashed()
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereName($value)
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property int $display_order
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereMetaTitle($value)
 * @property int $show_on_header
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereShowOnHeader($value)
 * @property string|null $meta_img
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereMetaImg($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Term[] $terms
 * @property-read int|null $terms_count
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|Taxonomy whereId($value)
 */
class Taxonomy extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'taxonomies';

    protected $primaryKey = 'id';

    public function terms() {
        return $this->hasMany(Term::class, 'taxonomy_id');
    }
}
