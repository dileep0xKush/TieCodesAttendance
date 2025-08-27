<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class AttendanceController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Attendance::where('out_time', '=', null)
                ->with('employee')
                ->latest()
                ->get();
            return DataTables::of($data)
                ->addColumn('full_name', function ($row) {
                    return $row->employee ? $row->employee->full_name : '';
                })
                ->make(true);
        }
        return view('attendance.index');
    }



    public function attendanceEmployees(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::with('attendance')->latest()->get();
            return DataTables::of($data)->make(true);
        }
    }


    public function inn($id)
    {
        $pakistanTime = Carbon::now()->setTimezone('Asia/Karachi')->format('H:i:s');

        $attendance = new Attendance;
        $attendance->user_id = $id;
        $attendance->inn_time = $pakistanTime;
        $innTimeCarbon = Carbon::createFromFormat('H:i:s', $attendance->inn_time, 'Asia/Karachi');
        $limitTime = Carbon::createFromFormat('H:i:s', '11:00:00', 'Asia/Karachi');
        $extraLimitTime = Carbon::createFromFormat('H:i:s', '12:00:00', 'Asia/Karachi');

        if ($innTimeCarbon > $extraLimitTime) {
            $attendance->status = "Toooo Late";
        } elseif ($innTimeCarbon > $limitTime) {
            $attendance->status = "Late";
        } else {
            $attendance->status = "Acceptable";
        }
        $attendance->save();
        return redirect()->back()->with('success', 'Attendance Updates');
        // dd($attendance);
    }


    public function out($id)
    {
        // dd($id);
        $pakistanTime = Carbon::now()->setTimezone('Asia/Karachi')->format('H:i:s');
        $attendance = Attendance::find($id);
        $attendance->out_time = $pakistanTime;

        $innTime = Carbon::createFromFormat('H:i:s', $attendance->inn_time);
        $outTime = Carbon::createFromFormat('H:i:s', $pakistanTime);

        $hoursDifference = $innTime->diff($outTime);

        $totalHours = $hoursDifference->format('%H:%I');

        $attendance->hours = $totalHours;

        $attendance->save();
        return redirect()->back()->with('success', 'Attendance Updates');

    }


    public function wfh($id)
    {
        dd($id);
    }


    public function leave($id)
    {
        dd($id);
    }
}
