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
                    <h4 class="card-title">Table Animal</h4>
                    <a title="new" href="{{ route('admin.admin_animals.create') }}"
                        class="btn btn-sm btn-info py-2 mb-2">Add new</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Species</th>
                                <th>Breed</th>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Color</th>
                                <th>Owner</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($animal as $item)
                            <tr>
                                <td>{{ Str::upper($item->species) }}</td>
                                <td>{{ Str::upper($item->breed) }}</td>
                                <td>{{ Str::upper($item->name) }}</td>
                                <td>{{ Str::upper($item->date_of_birth)}}</td>
                                <td>{{ Str::upper($item->gender) }}</td>
                                <td>{{ Str::upper($item->color)}}</td>
                                <td>{{ Str::upper($item->owner->first_name). ' '. Str::upper($item->owner->last_name)}}
                                </td>
                                <td><label
                                        class="badge {{ $item->owner->status == '1' ? 'badge-success' : 'badge-danger' }}">{{
                                        $item->owner->status == '1' ? 'Active' : 'Inactive'
                                        }}</label></td>

                                <td>
                                    <a href="{{ route('admin.admin_animals.edit', $item->id) }}"
                                        class="btn btn-info py-1 btn-icon float-start">
                                        <i class="ti-pencil"></i>
                                    </a>

                                    <form method="post" action="{{ route('admin.admin_animals.destroy', $item->id) }}">
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