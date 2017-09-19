<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Unice{
/**
 * App\Models\Unice\Device
 *
 * @property-read \App\Models\Unice\DeviceState $state
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unice\DeviceState[] $stateHistory
 * @property-read \App\Models\Unice\MapDeviceType $type
 * @property-read \App\Models\Unice\Unice $unice
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\Device onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\Device withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\Device withoutTrashed()
 */
	class Device extends \Eloquent {}
}

namespace App\Models\Unice{
/**
 * App\Models\Unice\DeviceState
 *
 * @property-read \App\Models\Unice\Device $device
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\DeviceState onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\DeviceState withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\DeviceState withoutTrashed()
 */
	class DeviceState extends \Eloquent {}
}

namespace App\Models\Unice{
/**
 * App\Models\Unice\MapDeviceType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unice\Device[] $devices
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\MapDeviceType onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\MapDeviceType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\MapDeviceType withoutTrashed()
 */
	class MapDeviceType extends \Eloquent {}
}

namespace App\Models\Unice{
/**
 * App\Models\Unice\MapUniceType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unice\Unice[] $unices
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\MapUniceType onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\MapUniceType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\MapUniceType withoutTrashed()
 */
	class MapUniceType extends \Eloquent {}
}

namespace App\Models\Unice{
/**
 * App\Models\Unice\Unice
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unice\Device[] $devices
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\Unice onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\Unice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unice\Unice withoutTrashed()
 */
	class Unice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
	class User extends \Eloquent {}
}

