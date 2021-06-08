<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!\App\Permission::count()) {

            $items = [
                ['name' => 'read_able', 'description' => 'Read posts'],
                ['name' => 'write_able', 'description' => 'Create posts'],
                ['module_name' => 'adjust_able', 'description' => 'Create'],
                ['module_name' => 'remove_able', 'description' => 'remove posts'],
                ['module_name' => 'approve_able', 'description' => 'approve posts'],
                ['module_name' => 'cancel_able', 'description' => 'cancel voucher'],
                ['module_name' => 'status', 'description' => 'status of voucher'],
            ];

            foreach ($items as $item) {
                \App\Permission::create($item);
            }
    }
}
