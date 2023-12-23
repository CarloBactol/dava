@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin: 0 auto;">

        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="card-title">Employee List</h4>
                    @if (Auth::user()->role == "super_admin")
                    <a title="new" href="{{ route('admin.user_branches.create') }}"
                        class="btn btn-sm btn-info py-2 mb-2">Add new</a>
                    @endif

                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Branch</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_branch as $item)
                            <tr>
                                <td>{{ Str::ucfirst($item->first_name) }}</td>
                                <td>{{ Str::ucfirst($item->last_name) }}</td>
                                <td>{{ Str::ucfirst($item->email) }}</td>
                                <td>{{ Str::ucfirst($item->branch) }}</td>
                                <td><label
                                        class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-danger' }}">{{
                                        $item->status == '1' ? 'Active' : 'Inactive'
                                        }}</label></td>

                                <td>
                                    <a href="{{ route('admin.user_branches.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start">
                                        <i class="ti-pencil"></i>
                                    </a>

                                    <form method="post" action="{{ route('admin.user_branches.destroy', $item->id) }}">
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
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
        $(".alert").show("slow").delay(3000).hide("slow");
    } );
</script>
@endsection