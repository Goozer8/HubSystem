@extends('admin_dashboard')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('add.customer') }}" 
                            class="btn btn-primary rounded-pill waves-effect waves-light ">Add Customer</a>
                        </ol>
                    </div>
                    <h4 class="page-title">All Customer</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted font-13 mb-4">


                        </p>

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                        
                        
                            <tbody>
                                @foreach($category as $key=>$item) 
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>
                                    <a href="{{ route('edit.customer', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="{{ route('delete.customer', $item->id) }}" class="btn btn-danger btn-sm" id="delete" >Delete</a>

                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
        <!-- end row-->
        
    </div> <!-- container -->

</div> <!-- content -->



@endsection