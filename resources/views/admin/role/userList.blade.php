@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <form action="{{ route('adminList') }}" method="get">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="searchKey" class="form-control " placeholder="Admin Name.."
                                   >
                                <button class="btn btn-outline-primary " type="submit" id="button-addon2"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex mb-3">
                    <div class="mr-3">
                        <a href="{{route('adminList')}}"><button class="btn btn-primary"> <i class="fa-solid fa-users-gear"></i> Admin List <span class="badge bg-light text-dark">{{$adminCount }}</span></button></a>
                    </div>
                    <div class="">
                        <a href="{{ route('userList')}}"><button class="btn btn-primary"><i class="fa-solid fa-users-gear"></i> User List <span class="badge bg-light text-dark">{{ $data->total() }}</span></button></a>
                    </div>
                </div>
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
                                        <a href="{{ route('accountProfile',$p->id)}}">{{ $p->name }}</a>
                                        @else
                                        <a href="{{ route('accountProfile',$p->id)}}">{{ $p->nickname }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $p->email}}</td>
                                    <td>{{ $p->phone}}</td>
                                    <td>{{ $p->address }}</td>
                                    <td>
                                            @if (auth()->user()->role == 'superadmin')
                                            @if (auth()->user()->id != $p->id)
                                                <a  href="{{ route('changeAdminRole',$p->id)}}" class="btn btn-outline-primary"><i
                                                    class="fa-solid fa-circle-up"></i> Change to Admin Role</a>
                                            <a  href="{{ route('userDelete',$p->id)}}" class="btn btn-outline-danger"><i
                                                class="fa-solid fa-trash"></i></i></a>
                                            @endif
                                           @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mr-4"> {{ $data->links('pagination::bootstrap-5') }}</div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
