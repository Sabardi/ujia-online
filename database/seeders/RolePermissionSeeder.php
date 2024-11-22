<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view courses',
            'create courses',
            'update courses',
            'delete courses',
        ];

        foreach ($permissions as $permission) {
            // Gunakan updateOrCreate untuk menambahkan atau memperbarui permission
            Permission::updateOrCreate([
                'name' => $permission,
            ]);
        }

        // Menggunakan updateOrCreate untuk role teacher
        $teacherRole = Role::updateOrCreate([
            'name' => 'teacher',
        ]);

        // Memberikan permission kepada role teacher
        $teacherRole->syncPermissions($permissions);

        // Menggunakan updateOrCreate untuk role student
        $studentRole = Role::updateOrCreate([
            'name' => 'student',
        ]);

        // Memberikan permission kepada role student
        $studentRole->givePermissionTo('view courses');

        // Menggunakan updateOrCreate untuk user
        $user = User::updateOrCreate(
            ['email' => 'fany@teacher.com'], // Kriteria untuk update atau create berdasarkan email
            [
                'name' => 'Fany',
                'password' => bcrypt('fany@teacher.com'),
            ]
        );

        // Menetapkan role ke user
        $user->assignRole($teacherRole);
    }

}
