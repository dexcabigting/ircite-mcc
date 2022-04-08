<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class EmployeePayrollController extends Controller
{
    public function calculatePayroll(Request $request, $employee)
    {
        $employee = Employee::find($employee);

        if ($employee == null) {
            return response()->json(['message' => 'Employee does not exist.'], 404);
        }

        $holidays = [
            '01-01-2022',
            '23-01-2022',
            '01-02-2022',
            '02-02-2022',
            '15-02-2022',
            '25-02-2022',
            '09-04-2022',
            '14-04-2022',
            '15-04-2022',
            '16-04-2022',
            '17-04-2022',
            '27-04-2022',
            '01-05-2022',
            '02-05-2022',
            '12-06-2022',
            '19-06-2022',
            '09-07-2022',
            '27-07-2022',
            '30-07-2022',
            '21-08-2022',
            '29-08-2022',
            '10-09-2022',
            '08-10-2022',
            '01-11-2022',
            '02-11-2022',
            '30-11-2022',
            '08-12-2022',
            '24-12-2022',
            '25-12-2022',
            '30-12-2022',
            '31-12-2022'
        ];

        // Validate dates
        $dates = $request->validate([
            'startDate' => ['required', 'date', 'before:endDate'],
            'endDate' => ['required', 'date', 'after:startDate'],
        ]);

        $days = $this->getWorkingDays($dates['startDate'], $dates['endDate'], $holidays);

        $leaves = $employee->sickLeaveCredits; + $employee->vacationLeaveCredits;

        // Parse dates
        
        // If employee exists, get hourly rate
        $hourlyRate = $employee->hourlyRate;
        
        $perDay = $hourlyRate * 9;

        return response()->json([
            'payroll' => [
                'salary' => ($days - $leaves) * $perDay
            ]
        ], 200);
    }

    public function getWorkingDays($startDate, $endDate, $holidays)
    {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        $days = ($endDate - $startDate) / 86400 + 1;

        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);

        $the_first_day_of_week = date("N", $startDate);
        $the_last_day_of_week = date("N", $endDate);

        if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
        }
        else {
            if ($the_first_day_of_week == 7) {
                $no_remaining_days--;
    
                if ($the_last_day_of_week == 6) {
                    $no_remaining_days--;
                }
            }
            else {
                $no_remaining_days -= 2;
            }
        }

        $workingDays = $no_full_weeks * 5;

        if ($no_remaining_days > 0 )
        {
        $workingDays += $no_remaining_days;
        }

        //We subtract the holidays
        foreach($holidays as $holiday){
            $time_stamp=strtotime($holiday);
            //If the holiday doesn't fall in weekend
            if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
                $workingDays--;
        }

        return $workingDays;
    }
}
