@extends('admin.layouts.master')

@section('content')
 <!-- Begin Page Content -->
 <div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">OrderList</h6>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>date</th>
                            <th>order code</th>
                            <th>user name </th>
                            <th class="col-3">action</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">

                                @foreach ($order as $item )
                                <tr>
                                    <input type="hidden" id="orderCode" value="{{$item->order_code}}">
                                    <td>{{ \Carbon\Carbon::parse($item->order_date)->format('d-M-Y') }}</td>
                                        <td><a href="{{ route('adminOrderDetails', $item-> order_code)}}">{{ $item-> order_code}}</a></td>
                                        <td> <a href="{{route('accountProfile',$item->user_id)}}">{{ $item-> user_name}}</a> </td>

                                        <td class="d-flex justify-content-arround">
                                            <select name="status" class="form-control statusChange">
                                                <option value="0" @if ($item->status == 0) selected @endif>Pending</option>
                                                <option value="1" @if ($item->status == 1) selected @endif>Accept</option>
                                                <option value="2" @if ($item->status == 2) selected @endif>Reject</option>
                                            </select>

                                        </td>
                                    </tr>
                                @endforeach

                    </tbody>
                </table>
                <span class="d-flex justify-content-end">
                    {{ $order->links('pagination::bootstrap-5') }}
                </span>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('script-section')
<script>
$(document).ready(function() {
    $('.statusChange').change(function() {
        var currentStatus = $(this).val();
        var orderCode = $(this).parents("tr").find("#orderCode").val();

        var data = {
            'status': currentStatus,
            'ordercode': orderCode
        };
        $.ajax({
                type: 'get',
                url: 'change/status',
                data: data,
                dataType: 'json',
      })
    });
});

</script>

@endsection
