@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin: 0 auto;">

        </div>
    </div>
    <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="card-title">Mapping List</h4>
                    <a title="new" href="{{ route('admin.admin_branchs.create') }}"
                        class="btn btn-sm btn-info py-2 mb-2">Add new</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Address</th>
                                <th>Services</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Auth::user()->role == "super_admin")
                            @foreach ($branch as $item)
                            <tr>
                                <td>{{ Str::ucfirst($item->address) }}</td>
                                <td>{{ Str::limit(Str::upper($item->content), 20, "...") }}</td>

                                <td><label
                                        class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-danger' }}">{{
                                        $item->status == '1' ? 'Active' : 'Inactive'
                                        }}</label></td>

                                <td>
                                    <a href="{{ route('admin.admin_branchs.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    @if (Auth::user()->role == "super_admin")
                                    <form method="post" action="{{ route('admin.admin_branchs.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger py-1 btn-icon">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                            @endif

                            @if (Auth::user()->role == "branch_admin")
                            @foreach ($one_branch as $item)
                            <tr>
                                <td>{{ Str::ucfirst($item->address) }}</td>
                                <td>{{ Str::limit(Str::upper($item->content), 20, "...") }}</td>

                                <td><label
                                        class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-danger' }}">{{
                                        $item->status == '1' ? 'Active' : 'Inactive'
                                        }}</label></td>

                                <td>
                                    <a href="{{ route('admin.admin_branchs.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    @if (Auth::user()->role == "super_admin")
                                    <form method="post" action="{{ route('admin.admin_branchs.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger py-1 btn-icon">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                            @endif

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