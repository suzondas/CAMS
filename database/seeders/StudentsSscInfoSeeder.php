<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentsSscInfo;

class StudentsSscInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample data
        StudentsSscInfo::create([
            'name' => 'John Doe',
            'name_bn' => 'জন ডো',
            'board_name' => 'Dhaka Board',
            'roll' => '123456',
            'registration' => '789123',
            'gpa' => 4.75,
            'ssc_group' => 'Science',
            'ssc_group' => 'Science',
            'passing_year' => 2023,
            'session' => '2020-2022',
            'esif_serial' => 'ESIF12345',
            'quota_name' => 'General',
            'mobile' => '01712345678',
            'gender' => 'Male',
            'dob' => '2000-01-01',
            'email' => 'john.doe@example.com',
            'address' => '123 Example St, Dhaka',
        ]);

        StudentsSscInfo::create([
            'name' => 'Jane Smith',
            'name_bn' => 'জেন স্মিথ',
            'board_name' => 'Chittagong Board',
            'roll' => '654321',
            'registration' => '987654',
            'gpa' => 4.60,
            'ssc_group' => 'Business Studies',
            'ssc_group' => 'Business Studies',
            'passing_year' => 2023,
            'session' => '2020-2022',
            'esif_serial' => 'ESIF67890',
            'quota_name' => 'Reserved',
            'mobile' => '01798765432',
            'gender' => 'Female',
            'dob' => '2001-02-02',
            'email' => 'jane.smith@example.com',
            'address' => '456 Another St, Chittagong',
        ]);

        // Add more records as needed
    }
}
