@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4> Payments Status</h4>
                        {{-- <a href="{{ route('admin.owners.index') }}" class="btn btn-md btn-info">Back</a> --}}
                        <a href="{{ route('admin.payments.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.payments.update', $gcash->id)}}" method="POst"
                        enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" disabled class="form-control   @error('email') is-invalid @enderror"
                                name="email" value="{{ $gcash->email }}" id="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="phone_no">Phone No</label>
                            <input type="text" disabled class="form-control @error('phone_no') is-invalid @enderror"
                                name="phone_no" value="{{  $gcash->phone_no }}" id="phone_no" placeholder="phone_no">
                        </div>
                        <div class="form-group">
                            <label for="reference_no">Reference No</label>
                            <input type="text" disabled
                                class="form-control  @error('reference_no') is-invalid @enderror" name="reference_no"
                                value="{{  $gcash->reference_no }}" id="reference_no" placeholder="reference_no">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="0" {{ $gcash->status == "0" ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ $gcash->status == "1" ? 'selected' : '' }}>Paid
                                </option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection