<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
	public function test_spatie()
	{
		// $role = Role::create(['name' => 'worker']);
		// $permission = Permission::create(['name' => 'index transaction']);

		// $role->givePermissionTo($permission);
		// $permission->assignRole($role);

		//menambahkan role buat user yang dipake login
		// $user = auth()->user();
		// $user->assignRole("worker");
		// return $user;

		//menambahkan role buat user yang tidak dipake login
		// $user = User::where('id',3)->first();
		// $user->assignRole("worker");
		// return $user;

		// $user = User::with('roles')->get();
		// return $user;

		//menghapus role buat user yang dipake login
		// $user = auth()->user();
		// $user->removeRole("worker");

		//menghapus role buat user yang tidak dipake login
		// $user = User::where('id',3)->first();
		// $user->removeRole("worker");
	}
}