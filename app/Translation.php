<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Translation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translation query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $lang
 * @property string|null $lang_key
 * @property string|null $lang_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereLangKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereLangValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translation whereUpdatedAt($value)
 */
class Translation extends Model
{
  //
}
