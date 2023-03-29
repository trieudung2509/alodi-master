<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

/**
 * App\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RoleTranslation[] $role_translations
 * @property-read int|null $role_translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $permissions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
class Role extends Model
{
    protected $with = ['role_translations'];

    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $role_translation = $this->role_translations->where('lang', $lang)->first();
        return $role_translation != null ? $role_translation->$field : $this->$field;
    }

    public function role_translations(){
      return $this->hasMany(RoleTranslation::class);
    }
}
