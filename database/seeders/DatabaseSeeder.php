<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tool;
use App\Models\User;
use App\Models\Product;
use App\Models\Visible;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\SimeProductSeeder;
use Spatie\Permission\Models\Permission;
use Database\Seeders\AccorroniProductsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Operator', 'Servicer', 'Organizer'];
        $permissions = [
            'products.list' => 'Admin|Operator',
            'products.create' => 'Admin|Operator|Organizer',
            'products.update' => 'Admin|Operator|Servicer|organizer',
            'products.delete' => 'Admin|Operator',
            'organizations.list' => 'Admin|Operator',
            'organizations.create' => 'Admin|Operator',
            'organizations.update' => 'Admin|Operator|organizer',
            'organizations.delete' => 'Admin|Operator',
            'users.list' => 'Admin|Operator',
            'users.create' => 'Admin|Operator',
            'users.update' => 'Admin|Operator',
            'users.delete' => 'Admin|Operator',
            'tools.list' => 'Admin|Operator',
            'tools.create' => 'Admin|Operator',
            'tools.update' => 'Admin|Operator',
            'tools.delete' => 'Admin|Operator',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        foreach ($permissions as $name => $roles) {
            $permission = Permission::create(['name' => $name]);
            $toRoles = explode('|', $roles);
            foreach ($toRoles as $toRole) {
                $permission->assignRole($toRole);
            }
        }
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'zoli.szabok@gamil.com',
            'email_verified_at' => Carbon::now(),
            'password' => '1234',
            'remember_token' => Str::random(10),
            'organization_id' => 1,
        ]);
        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now(),
            'password' => '1234',
            'remember_token' => Str::random(10),
            'organization_id' => 1
        ]);
        $user2 = User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test@test2.com',
            'email_verified_at' => Carbon::now(),
            'password' => '1234',
            'remember_token' => Str::random(10),
            'organization_id' => 1
        ]);
        $user3 = User::factory()->create([
            'name' => 'Test User 3',
            'email' => 'test@test3.com',
            'email_verified_at' => Carbon::now(),
            'password' => '1234',
            'remember_token' => Str::random(10),
            'organization_id' => 1
        ]);

        $admin->assignRole('Organizer');
        $user1->assignRole('Operator');
        $user2->assignRole('Organizer');
        $user3->assignRole('Servicer');
        Tool::factory()->create([
            'id' => '1',
            'name' => 'Brava Slim 25 BT',
            'category' => 'kazán',
            'tag' => 'Próba tag',
            'factory_name' => 'Sime',

        ]); /*
$product = Product::factory()->create([
'owner_name' => 'Proba Név',
'city' => 'Biatorbágy',
'street' => 'Géza fejedelem u. 6.',
'zip' => '2051',
'serial_number' => '4518300786',
'installation_date' => '2023-08-20',
'warrantee_date' => '2024-08-20',
'purchase_place' => 'Két Kör Kft.',
'comments' => 'HMV-t nem használják',
'tool_id' => '1',
]);
$product->users()->attach($user1->id);
$product->users()->attach($user2->id);
*/

        $this->call([
            SimeProductSeeder::class,
            AccorroniProductsSeeder::class,
            FerroliProductsSeeder::class,
            LEBTORProductsSeeder::class,
        ]);




        $productTest1 = Product::whereId(1)->first();
        $productTest2 = Product::whereId(2)->first();
        $user1->products()->attach($productTest1);
        $user1->products()->attach($productTest2);
        $user2->products()->attach($productTest2);
        Visible::create([
            'user_id' => $user1->id,
            'product_id' => $productTest1->id,
            'isVisible' => 1
        ]);
        Visible::create([
            'user_id' => $user1->id,
            'product_id' => $productTest2->id,
            'isVisible' => 1
        ]);
        Visible::create([
            'user_id' => $user2->id,
            'product_id' => $productTest2->id,
            'isVisible' => 1
        ]);

    }
}
