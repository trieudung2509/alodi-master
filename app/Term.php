<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Term
 *
 * @property string $name
 * @property string $slug
 * @property int $term_group
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Term newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Term newQuery()
 * @method static \Illuminate\Database\Query\Builder|Term onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Term query()
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereTermGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereTermId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Term withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Term withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $description
 * @property int $parent
 * @property int $count
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereParent($value)
 * @property string $taxonomy_name
 * @property int $taxonomy_id
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereTaxonomyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereTaxonomyName($value)
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property int $display_order
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereMetaTitle($value)
 * @property int $show_on_home_page
 * @property int $show_on_header
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereShowOnHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereShowOnHomePage($value)
 * @property string|null $meta_img
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereMetaImg($value)
 * @property string|null $small_img
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereSmallImg($value)
 * @property int|null $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Blog[] $blogs
 * @property-read int|null $blogs_count
 * @property-read \App\Taxonomy $taxonomy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TermRelationship[] $term_relationships
 * @property-read int|null $term_relationships_count
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereParentId($value)
 * @property int $id
 * @property int $level
 * @property-read \Illuminate\Database\Eloquent\Collection|Term[] $childrenTerms
 * @property-read int|null $children_terms_count
 * @property-read Term|null $parentTerm
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereLevel($value)
 */
class Term extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'terms';

    protected $primaryKey = 'id';

    public function taxonomy() {
        return $this->belongsTo(Taxonomy::class, 'taxonomy_id');
    }

    public function blogs() {
        return $this->belongsToMany(Blog::class);
    }

    public function childrenTerms()
    {
        return $this->hasMany(Term::class, 'parent_id')->with('childrenTerms');
    }

    public function parentTerm()
    {
        return $this->belongsTo(Term::class, 'parent_id');
    }
}
