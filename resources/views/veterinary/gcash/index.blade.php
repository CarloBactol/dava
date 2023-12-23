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
                    <h4 class="card-title">Apps Subscription</h4>
                </div>
                <div class="table-responsive">

                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Phone Number</th>
                                <th>Reference Number</th>
                                <th>Payment Date</th>
                                <th>Approved Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paid as $item)
                            <tr>

                                <td>{{ Str::lower($item->email) }}</td>
                                <td>{{ number_format($item->amount, 2) }}</td>
                                <td>{{ $item->phone_no }}</td>
                                <td>{{ $item->reference_no }}</td>
                                <td>{{ $item->created_at->format('M d, yy') }}</td>
                                <td>{{ $item->updated_at->format('M d, yy') }}</td>
                                <td><label
                                        class="badge {{ $item->status == '1' ? 'badge-success' : 'badge-warning' }}">{{
                                        $item->status == '1' ? 'Approved' : 'Pending'
                                        }}</label></td>
                                {{-- <td>
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
                                </td> --}}
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