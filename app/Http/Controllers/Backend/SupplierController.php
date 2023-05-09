<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;

class SupplierController extends Controller
{
    public function AllSupplier(){
        $supplier = Supplier::latest()->get();
        return view('backend.employee.supplier.all_supplier', compact('supplier'));
    }//End Method

    public function AddSupplier(){
        return view('backend.employee.supplier.add_supplier');
    }//End Method

    public function StoreSupplier(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:customers|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'shopname' => 'required|max:255',
            'account_holder' => 'required|max:255',
            'account_number' => 'required',
            'type' => 'required',
        ]);


        Supplier::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'created_at' => Carbon::now(),
        ]);

        
        $notification = array(
            'message' => 'Supplier Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.supplier')->with($notification);

        
    }//End Method

    public function EditSupplier($id){
        
        $supplier = Supplier::findOrFail($id);
        return view('backend.employee.supplier.edit_supplier', compact('supplier'));
    }//End Method

    public function UpdateSupplier(Request $request){

        $supplier_id = $request->id;

        if($request->file('image')){

            Supplier::findOrFail($supplier_id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'created_at' => Carbon::now(),

            ]);
    
            
            $notification = array(
                'message' => 'Supplier Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.supplier')->with($notification);

        }else{

            Supplier::findOrFail($supplier_id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'created_at' => Carbon::now(),

            ]);
    
            
            $notification = array(
                'message' => 'Supplier Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.supplier')->with($notification);
        } //End Else

    } //End Method

    public function DeleteSupplier($id){

        Supplier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

        
    }//End Method

    public function DetailsSupplier($id){
        
        $supplier = Supplier::findOrFail($id);
        return view('backend.employee.supplier.details_supplier', compact('supplier'));
    }//End Method
}
