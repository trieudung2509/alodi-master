<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BusinessSetting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSetting query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type
 * @property string|null $value
 * @property string|null $lang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSetting whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSetting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSetting whereValue($value)
 */
class BusinessSetting extends Model
{
    //
}
