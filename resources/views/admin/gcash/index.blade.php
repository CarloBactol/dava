@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title"> Pending Payment</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Reference No</th>
                                    <th>Amount</>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{ Str::ucfirst($item->email) }}</td>
                                    <td>{{ Str::ucfirst($item->phone_no) }}</td>
                                    <td>{{ Str::upper($item->reference_no)}}</td>
                                    <td>{{ number_format($item->amount, 2) }}</td>
                                    <td><label
                                            class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-danger' }}">{{
                                            $item->status == '1' ? 'Paid' : 'Pending'
                                            }}</label></td>

                                    <td>
                                        <a href="{{ route('admin.payments.edit', $item->id) }}"
                                            class="btn btn-info py-1 btn-icon float-start">
                                            <i class="ti-pencil"></i>
                                        </a>

                                        <form method="post" action="{{ route('admin.payments.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger py-1 btn-icon">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title"> Paid Payment</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="myPaid">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Reference No</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paid as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{ Str::ucfirst($item->email) }}</td>
                                    <td>{{ Str::ucfirst($item->phone_no) }}</td>
                                    <td>{{ Str::upper($item->reference_no)}}</td>
                                    <td><label
                                            class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-danger' }}">{{
                                            $item->status == '1' ? 'Paid' : 'Pending'
                                            }}</label></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
        $(".alert").show("slow").delay(3000).hide("slow");
    } );
    $(document).ready( function () {
        $('#myPaid').DataTable();
    } );
</script>
@endsection