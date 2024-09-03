@extends('admin.layouts.master')

@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                </div>
                <div class="">
                    <a href="{{ route('categoryCreatePage') }}"><i class="fa-solid fa-plus"></i> Add Category</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Create Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                                @foreach ($data as $item )
                                <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item-> name}}</td>
                                        <td>{{ $item->created_at ->format('j-F-Y')}}</td>
                                        <td>
                                                <a href="{{ route('categoryEdit',$item->id) }}" class="btn btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{ route('categoryDelete',$item->id) }}" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></i></a>

                                        </td>
                                    </tr>
                                @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection
