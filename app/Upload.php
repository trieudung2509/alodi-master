<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Upload
 *
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Upload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Upload newQuery()
 * @method static \Illuminate\Database\Query\Builder|Upload onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Upload query()
 * @method static \Illuminate\Database\Query\Builder|Upload withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Upload withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $file_original_name
 * @property string|null $file_name
 * @property int|null $user_id
 * @property int|null $file_size
 * @property string|null $extension
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereFileOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereUserId($value)
 * @property int|null $width
 * @property int|null $height
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upload whereWidth($value)
 */
class Upload extends Model
{
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'file_original_name', 'file_name', 'user_id', 'extension', 'type', 'file_size', 'width', 'height'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
