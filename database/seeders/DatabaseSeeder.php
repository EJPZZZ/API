<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Income;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		User::factory(10)
			->has(Bill::factory()->count(5))
			->has(Income::factory()->count(5))
			->create();

		// User::factory()->create([
		// 	'name' => 'Test User',
		// 	'email' => 'test@example.com',
		// ]);
	}
}
