<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Banner
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $photo
 * @property string|null $url
 * @property int $position
 * @property int $published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUrl($value)
 */
class Banner extends Model
{
    //
}
