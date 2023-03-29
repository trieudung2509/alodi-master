<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FirebaseNotification
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $title
 * @property string|null $text
 * @property string|null $item_type
 * @property int $item_type_id
 * @property int $receiver_id
 * @property int $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification whereItemType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification whereItemTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseNotification whereUpdatedAt($value)
 */
class FirebaseNotification extends Model
{
    //
}
