<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendence;
use App\Models\Employee;
use Carbon\Carbon;

class AttendenceController extends Controller
{
    public function EmployeeAttendenceList()    {

        $allData = Attendence::select('date')->groupBy('date')->orderBy('id', 'desc')->get();

        return view('backend.employee.attendence.employee_attend_list', compact('allData'));
    }//end of EmployeeAttendenceList

    public function AddEmployeeAttendence(){
         $employees = Employee::all();
         return view('backend.employee.attendence.add_employee_attend', compact('employees'));
    }//end of AddEmployeeAttendence

    public function EmployeeAttendenceStore (Request $request){

        Attendence::where('date',date('Y-m-d',strtotime($request->date)))->delete();
        
        $countemployee = count($request->employee_id);

        for($i=0; $i<$countemployee; $i++){
            $attend_status = 'attend_status'.$i;
            $attend = new Attendence();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }

        $notification = array(
            'message' => 'Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attend.list')->with($notification); 


    }//end of EmployeeAttendenceStore4

    public function EditEmployeeAttendence($date){
        $employees = Employee::all();
        $editData = Attendence::where('date', $date)->get();
        return view('backend.employee.attendence.edit_employee_attend', compact('employees', 'editData'));
    }//end of EditEmployeeAttendence

    public function ViewEmployeeAttendence($date){

        $details = Attendence::where('date',$date)->get();
   return view('backend.employee.attendence.details_employee_attend',compact('details'));


   }// End Method 
    
}
