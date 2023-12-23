@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="margin: 0 auto;">

        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="card-title">Table Veterinary</h4>
                    <a title="new" href="{{ route('admin.admin_veterinaries.create') }}"
                        class="btn btn-sm btn-info py-2 mb-2">Add new</a>
                </div>
                <div class="table-responsive">

                    {{-- <div class="col-md-8">
                        <h1>Under Construction</h1>
                        <div class="spinner-grow text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                    </div> --}}

                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Branch</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Specialization</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($veterinary as $item)
                            <tr>
                                <td>{{ Str::ucfirst($item->branch) }}</td>
                                <td>{{ Str::ucfirst($item->first_name) }}</td>
                                <td>{{ Str::ucfirst($item->last_name) }}</td>
                                <td>{{ Str::ucfirst($item->specialize_id) }}</td>
                                <td>{{ Str::limit(Str::upper($item->address), 20, "...") }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>{{ $item->email }}</td>
                                <td><label
                                        class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-danger' }}">{{
                                        $item->status == '1' ? 'Active' : 'Inactive'
                                        }}</label></td>
                                <td>
                                    <a href="{{ route('admin.admin_veterinaries.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start">
                                        <i class="ti-pencil"></i>
                                    </a>

                                    <form method="post"
                                        action="{{ route('admin.admin_veterinaries.destroy', $item->id) }}">
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