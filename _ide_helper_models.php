<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AccessToken
 *
 * @property int $id
 * @property string|null $token
 * @property int $used
 * @property int $user_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken whereUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccessToken whereUserId($value)
 */
	class AccessToken extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Log
 *
 * @property int $id
 * @property int $user_id
 * @property string $what
 * @property string $when
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\LogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereWhat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereWhen($value)
 */
	class Log extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Organization
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $city
 * @property string|null $tax_number
 * @property string|null $address
 * @property string|null $zip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\OrganizationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization query()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereZip($value)
 */
	class Organization extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Partial
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $name
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|Partial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partial query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partial whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partial wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partial whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partial whereUpdatedAt($value)
 */
	class Partial extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string|null $owner_name
 * @property string|null $installer_name
 * @property int $user_id
 * @property string|null $city
 * @property string|null $street
 * @property string|null $zip
 * @property string|null $purchase_place
 * @property string $serial_number
 * @property string|null $comments
 * @property \Illuminate\Support\Carbon|null $installation_date
 * @property \Illuminate\Support\Carbon|null $warrantee_date
 * @property \Illuminate\Support\Carbon|null $purchase_date
 * @property string|null $mac
 * @property int|null $access_to_wifi
 * @property int $tool_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Visible> $are_visible
 * @property-read int|null $are_visible_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Organization> $organizations
 * @property-read int|null $organizations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Partial> $partials
 * @property-read int|null $partials_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductLog> $product_logs
 * @property-read int|null $product_logs_count
 * @property-read \App\Models\Tool|null $tool
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAccessToWifi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInstallationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInstallerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMac($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOwnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePurchasePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereToolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWarranteeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereZip($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductLog
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $what
 * @property string|null $comment
 * @property string $when
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @method static \Database\Factories\ProductLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog whereWhat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductLog whereWhen($value)
 */
	class ProductLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tool
 *
 * @property int $id
 * @property string $name
 * @property string|null $category
 * @property string|null $tag
 * @property string|null $factory_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\ToolFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tool newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tool newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tool query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tool whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tool whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tool whereFactoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tool whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tool whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tool whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tool whereUpdatedAt($value)
 */
	class Tool extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property int|null $organization_id
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AccessToken> $AccessTokens
 * @property-read int|null $access_tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Visible> $are_visible
 * @property-read int|null $are_visible_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Log> $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Organization|null $organization
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Visible
 *
 * @property int $id
 * @property int $isVisible
 * @property int $product_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Visible newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visible newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visible query()
 * @method static \Illuminate\Database\Eloquent\Builder|Visible whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visible whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visible whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visible whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visible whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visible whereUserId($value)
 */
	class Visible extends \Eloquent {}
}

