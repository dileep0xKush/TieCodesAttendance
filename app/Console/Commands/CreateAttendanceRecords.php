<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;

class CreateAttendanceRecords extends Command
{
    protected $signature = 'attendance:create-records';
    protected $description = 'Create attendance records for all employees';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Check if attendance record already exists for today
            $existingRecord = Attendance::where('user_id', $employee->id)
                                        ->whereDate('created_at', Carbon::today())
                                        ->first();

            if (!$existingRecord) {
                // Create a new attendance record
                Attendance::create([
                    'user_id' => $employee->id,
                ]);
            }
        }

        $this->info('Attendance records created successfully.');
    }
}
