<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Models\PaySalary;
use App\Models\Employee;
use Carbon\Carbon;


class SalaryController extends Controller
{
    public function AddAdvanceSalary(){

        $employee = Employee::latest()->get();

        return view('backend.employee.salary.add_advance_salary', compact('employee'));
    }//end of AddAdvanceSalary

    public function AdvanceSalaryStore(Request $request){
        $validate = $request->validate([
            'month' => 'required|max:255',
            'year' => 'required|max:255',
        ]);

        $month = $request->month;
        $employee_id = $request->employee_id;

        $advanced = AdvanceSalary::where('month', $month)->where('employee_id', $employee_id)->first();

        if($advanced === NULL){
            AdvanceSalary::insert([
                'employee_id' => $employee_id,
                'month' => $month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Advance Salary Paid Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.advance.salary')->with($notification); 

        } else{
            $notification = array(
                'message' => 'Advance Already Paid',
                'alert-type' => 'warning'
            );
    
            return redirect()->back()->with($notification);

        }
    }//end of AdvanceSalaryStore

    public function AllAdvanceSalary(){
        $salary =   AdvanceSalary::latest()->get();
        return view('backend.employee.salary.all_advance_salary', compact('salary'));
    }//end of AllAdvanceSalary


    public function EditAdvanceSalary($id){
        $employee = Employee::latest()->get();
        $salary = AdvanceSalary::findOrFail($id);
        return view('backend.employee.salary.edit_advance_salary',compact('salary','employee'));

    }// End Method 


    public function AdvanceSalaryUpdate(Request $request){

        $salary_id = $request->id;

         AdvanceSalary::findOrFail($salary_id)->update([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(), 
            ]);

         $notification = array(
            'message' => 'Advance Salary Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.advance.salary')->with($notification); 


    }// End Method 

    ///////////////////////// Pay Salary //////////////////////

    public function PaySalary(){
        $employee = Employee::latest()->get();
        return view('backend.employee.salary.pay_salary', compact('employee'));
    }

    public function PayNowSalary($id){
        $paysalary = Employee::findOrFail($id); 
        return view('backend.employee.salary.paid_salary', compact('paysalary'));

    }//end of PayNowSalary

    public function EmployeeSalaryStore(Request $request){
        $employee_id = $request->id;

        PaySalary::insert([

            'employee_id' => $employee_id,
            'salary_month' => $request->month,
            'paid_amount' => $request->paid_amount,
            'advance_salary' => $request->advance_salary,
            'due_salary' => $request->due_salary,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Employee Salary Paid Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pay.salary')->with($notification); 

    }//end of EmployeeSalaryStore

    public function MonthSalary(){
        $paidsalary = PaySalary::latest()->get();
        return view('backend.employee.salary.month_salary', compact('paidsalary'));
    }
}
