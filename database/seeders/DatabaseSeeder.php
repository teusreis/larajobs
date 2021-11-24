<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\User;
use App\Models\Resume;
use App\Models\Company;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $normalUsers = User::factory(100)->create();

        $normalUsers->each(function ($user) {
            $resume = Resume::factory()->create([
                'user_id' => $user->id
            ]);

            Experience::factory()->count(5)->create([
                'resume_id' => $resume->id
            ]);

            Education::factory()->count(5)->create([
                'resume_id' => $resume->id
            ]);
        });

        $users = User::factory(20)->create([
            'isCompany' => true
        ]);

        $users->each(function ($user) use ($normalUsers) {
            $company = Company::factory()->create([
                'user_id' => $user->id
            ]);

            $jobs = Job::factory()->count(20)->create([
                'company_id' => $company->id
            ]);

            $jobs->each(function ($job) use ($normalUsers) {

                $normalUsers->each(function ($user) use ($job) {
                    $dayToSub = rand(0, 6);

                    DB::table('job_user')->insert([
                        'user_id' => $user->id,
                        'job_id' => $job->id,
                        'created_at' => Carbon::now()->subDay($dayToSub),
                        'updated_at' => Carbon::now()->subDay($dayToSub),
                    ]);
                });
            });
        });
    }
}
