@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <form action="{{ route('productList') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" name="searchKey" class="form-control " placeholder="Admin Name.."
                                   >
                                <button class="btn btn-outline-primary " type="submit" id="button-addon2"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="">
                        <a href="{{route('createAdminAccount')}}"><i class="fa-solid fa-plus"></i> Add Admin</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive  text-center">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th >Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $p)
                                <tr>
                                    <td>
                                        @if ($p->name != null )
                                        {{ $p->name }}
                                        @else
                                        {{ $p->nickname }}
                                        @endif
                                    </td>
                                    <td>{{ $p->email}}</td>
                                    <td>{{ $p->phone}}</td>
                                    <td>{{ $p->address }}</td>
                                    <td>

                                            @if (auth()->user()->role == 'superadmin')
                                            @if (auth()->user()->id != $p->id)
                                            <a  href="{{ route('adminDelete',$p->id)}}" class="btn btn-outline-danger"><i
                                                class="fa-solid fa-trash"></i></i></a>
                                            @endif
                                           @endif



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
