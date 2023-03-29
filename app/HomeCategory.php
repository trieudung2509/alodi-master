<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\HomeCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|HomeCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeCategory query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property string|null $subsubcategories
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HomeCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeCategory whereSubsubcategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeCategory whereUpdatedAt($value)
 */
class HomeCategory extends Model
{

}
