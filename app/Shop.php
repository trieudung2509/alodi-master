<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Shop
 *
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $logo
 * @property string|null $sliders
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $facebook
 * @property string|null $google
 * @property string|null $twitter
 * @property string|null $youtube
 * @property string|null $slug
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $pick_up_point_id
 * @property string|null $shipping_cost
 * @property float|null $delivery_pickup_latitude
 * @property float|null $delivery_pickup_longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereDeliveryPickupLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereDeliveryPickupLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereGoogle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop wherePickUpPointId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereShippingCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereSliders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereYoutube($value)
 */
class Shop extends Model
{

  protected $with = ['user'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
