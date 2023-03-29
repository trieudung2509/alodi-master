<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

/**
 * App\CustomerPackage
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $name
 * @property float|null $amount
 * @property int|null $product_upload
 * @property string|null $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage whereProductUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerPackage whereUpdatedAt($value)
 */
class CustomerPackage extends Model
{
    public function getTranslation($field = '', $lang = false){
      $lang = $lang == false ? App::getLocale() : $lang;
      $brand_translation = $this->hasMany(CustomerPackageTranslation::class)->where('lang', $lang)->first();
      return $brand_translation != null ? $brand_translation->$field : $this->$field;
    }
}
