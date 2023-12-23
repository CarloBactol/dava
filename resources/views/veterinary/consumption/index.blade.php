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
                    <a title="new" href="{{ route('veterinary.vet_consumptions.create') }}"
                        class="btn btn-sm btn-info py-2 mb-2">Add New</a>
                </div>
                <div class="table-responsive">

                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Consumption</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consumption as $item)
                            <tr>

                                <td>{{ Str::ucfirst($item->animal->name) }}</td>
                                <td>{{ Str::ucfirst($item->consumption) }}</td>
                                <td>{{ Str::ucfirst($item->quantity) }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>

                                <td>
                                    {{-- <a href="{{ route('admin.admin_veterinaries.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start">
                                        <i class="ti-pencil"></i>
                                    </a> --}}

                                    <form method="post"
                                        action="{{ route('veterinary.vet_consumptions.destroy', $item->id) }}">
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