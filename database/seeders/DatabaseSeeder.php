<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Employee;
use App\Models\PublicHoliday;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Country::factory()->create([
            'name' => 'Romania',
            'holiday_entitlement' => '32',
        ]);

        PublicHoliday::factory()->create([
            'name' => 'Test holiday',
            'country_id' => 1,
            'date' => now()->addDays(100)
        ]);

        PublicHoliday::factory()->create([
            'name' => 'Test holiday 2',
            'country_id' => 1,
            'date' => now()->addDays(25)
        ]);

        PublicHoliday::factory()->create([
            'name' => 'Test holiday 3',
            'country_id' => 1,
            'date' => now()->addDays(60)
        ]);

        Employee::factory()->create([
            'name' => 'Gheorghe Hagi',
            'country_id' => 1,
            'start_date' => now(),
        ]);
    }
}
