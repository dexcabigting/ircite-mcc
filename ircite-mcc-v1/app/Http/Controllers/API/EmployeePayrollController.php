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
    public function calculatePayroll(Request $request, Employee $employee)
    {
        if (!$employee) {
            return response(array('message' => 'Employee not found.', 404));
        }

        $holidays = [
            '01/01/2022',
            '23/01/2022',
            '01/02/2022',
            '02/02/2022',
            '15/02/2022',
            '25/02/2022',
            '09/04/2022',
            '14/04/2022',
            '15/04/2022',
            '16/04/2022',
            '17/04/2022',
            '27/04/2022',
            '01/05/2022',
            '02/05/2022',
            '12/06/2022',
            '19/06/2022',
            '09/07/2022',
            '27/07/2022',
            '30/07/2022',
            '21/08/2022',
            '29/08/2022',
            '10/09/2022',
            '08/10/2022',
            '01/11/2022',
            '02/11/2022',
            '30/11/2022',
            '08/12/2022',
            '24/12/2022',
            '25/12/2022',
            '30/12/2022',
            '31/12/2022'
        ];

        // Validate dates
        // $dates = $request->validate([
        //     'startDate' => ['required', 'date_format:mm/dd/yyyy', Rule::not_in($holidays)],
        //     'endDate' => ['required', 'date_format:mm/dd/yyyy', 'after:startDate', Rule::not_in($holidays)],
        // ]);

        // Parse dates
        $startDate = strtotime($request->input('startDate'));
        $endDate = strtotime($request->input('endDate'));
        // If employee exists, get hourly rate
        $hourlyRate = $employee->hourlyRate;

        $days = $startDate->diff($endDate);

        $perDay = $hourlyRate * 9;

        return response()->json([
            'days' => $days->d
        ]);
    }
}
