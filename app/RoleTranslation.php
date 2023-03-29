<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RoleTranslation
 *
 * @property-read \App\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|RoleTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleTranslation query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string $lang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RoleTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleTranslation whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleTranslation whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleTranslation whereUpdatedAt($value)
 */
class RoleTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'role_id'];

    public function role(){
      return $this->belongsTo(Role::class);
    }
}
