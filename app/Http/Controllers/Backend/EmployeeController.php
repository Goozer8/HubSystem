<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function AllEmployee(){

        $employee = Employee::latest()->get();
        return view('backend.employee.all_employee', compact('employee'));
    }//End Method


    public function AddEmployee(){
        return view('backend.employee.add_employee');
    }//End Method

    public function StoreEmployee(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:employees|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'salary' => 'required|max:255',
            'vacation' => 'required|max:255',
            'experience' => 'required',
        ],[
            'name.required' => 'This Employee Name Field Is Required',
        ]
        );


        Employee::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'created_at' => Carbon::now(),
        ]);

        
        $notification = array(
            'message' => 'Employee Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employee')->with($notification);

        
    }//End Method


    public function EditEmployee($id){
        
        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('employee'));

    }//End Method

    public function UpdateEmployee(Request $request){

        $employee_id = $request->id;

        if($request->file('image')){

            Employee::findOrFail($employee_id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'created_at' => Carbon::now(),

            ]);
    
            
            $notification = array(
                'message' => 'Employee Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.employee')->with($notification);
        }else{
            Employee::findOrFail($employee_id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'created_at' => Carbon::now(),

            ]);
    
            
            $notification = array(
                'message' => 'Employee Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.employee')->with($notification);
        } //End Else

    } //End Method


    public function DeleteEmployee($id){

        Employee::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        
    }//End Method

}
