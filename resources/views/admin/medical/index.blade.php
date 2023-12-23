@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6" style="margin: 0 auto;">
            {{-- {{ dd($med_rec) }} --}}
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h4 class="card-title">Medical Records</h4>
                    <a title="new" href="{{ route('admin.medicals.create') }}" class="btn btn-sm btn-info py-2 mb-2">Add
                        Patient</a>
                </div>
                <div class="table-responsive">

                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Veterinary</th>
                                <th>Patient Name</th>
                                <th>Diagnosis</th>
                                <th>Treatment</th>
                                <th>Notes</th>
                                <th>Cost (PHP)</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($med_rec as $item)
                            <tr>
                                <td>{{ Str::ucfirst($item->veterinarian->first_name) . " " .
                                    Str::ucfirst($item->veterinarian->last_name)}}</td>
                                <td>{{ Str::ucfirst($item->animal->name) }}</td>
                                <td>{{ Str::ucfirst($item->procedure) }}</td>
                                <td>{{ Str::ucfirst($item->type_of_procedure) }}</td>
                                <td>{!! Str::limit(Str::upper($item->notes), 20, "...") !!}</td>
                                <td>{{ number_format($item->cost, 2, '.', ',') }}</td>
                                <td>{{ $item->created_at->format('M d Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.medicals.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start">
                                        <i class="ti-pencil"></i>
                                    </a>

                                    <form method="post" action="{{ route('admin.medicals.destroy', $item->id) }}">
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