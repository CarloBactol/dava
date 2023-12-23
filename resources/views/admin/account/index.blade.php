@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-7 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="card-title"> Account List</h4>
                        <a title="new" href="{{ route('admin.account_gcashes.create') }}"
                            class="btn btn-sm btn-info py-2 mb-2">Add new</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Account Name</th>
                                    <th>Account No</th>
                                    <th>Subscription Cost</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($account as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{ Str::ucfirst($item->account_name) }}</td>
                                    <td>{{ $item->account_number }}</td>
                                    <td>{{ number_format($item->cost, 2) }}</td>
                                    <td><label
                                            class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-danger' }}">{{
                                            $item->status == '1' ? 'Active' : 'Inactive'
                                            }}</label></td>
                                    <td>
                                        <a href="{{ route('admin.account_gcashes.edit', $item->id) }}"
                                            class="btn btn-info py-1 btn-icon float-start">
                                            <i class="ti-pencil"></i>
                                        </a>

                                        <form method="post"
                                            action="{{ route('admin.account_gcashes.destroy', $item->id) }}">
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