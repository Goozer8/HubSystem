<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function AllCustomer(){

        $customer = Customer::latest()->get();
        return view('backend.employee.customer.all_customer', compact('customer'));
    }//End Method

    public function AddCustomer(){
        return view('backend.employee.customer.add_customer');
    }//End Method

    public function StoreCustomer(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:customers|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'shopname' => 'required|max:255',
            'account_holder' => 'required|max:255',
            'account_number' => 'required',
        ]);


        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'created_at' => Carbon::now(),
        ]);

        
        $notification = array(
            'message' => 'Customer Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);

        
    }//End Method


    public function EditCustomer($id){
        
        $customer = Customer::findOrFail($id);
        return view('backend.employee.customer.edit_customer', compact('customer'));
    }//End Method

    public function CustomerUpdate(Request $request){

        $customer_id = $request->id;

        if($request->file('image')){

            Customer::findOrFail($customer_id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'created_at' => Carbon::now(),

            ]);
    
            
            $notification = array(
                'message' => 'Customer Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.customer')->with($notification);

        }else{

            Customer::findOrFail($customer_id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'created_at' => Carbon::now(),

            ]);
    
            
            $notification = array(
                'message' => 'Customer Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.customer')->with($notification);
        } //End Else

    } //End Method

    public function DeleteCustomer($id){

        Customer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        
    }//End Method
}
