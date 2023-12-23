@extends('layouts.veterinary')
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
                    <h4 class="card-title">Patient Consumption Records</h4>
                    <a title="new" href="{{ route('veterinary.medecine_inventories.create') }}"
                        class="btn btn-sm btn-info py-2 mb-2">Add New</a>
                </div>
                <div class="table-responsive">

                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medecine as $item)
                            <tr>

                                <td>{{ Str::ucfirst($item->name) }}</td>
                                <td>{{ Str::ucfirst($item->quantity) }}</td>
                                <td>{!! Str::limit($item->description, 50, '...') !!}</td>
                                <td><label
                                        class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-danger' }}">{{
                                        $item->status == '1' ? 'Active' : 'Inactive'
                                        }}</label></td>
                                <td>
                                    <a href="{{ route('veterinary.medecine_inventories.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start">
                                        <i class="ti-pencil"></i>
                                    </a>

                                    <form method="post"
                                        action="{{ route('veterinary.medecine_inventories.destroy', $item->id) }}">
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