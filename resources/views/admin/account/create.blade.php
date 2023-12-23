@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4>Create Account</h4>
                        <a href="{{ route('admin.account_gcashes.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.account_gcashes.store')}}" method="Post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="account_name">Account Name</label><span class="text-danger">*</span>
                            <input type="text" class="form-control   @error('account_name') is-invalid @enderror"
                                name="account_name" value="{{ old('account_name') }}" id="account_name"
                                placeholder="Account Name">
                            @error('account_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="account_number">Account No</label><span class="text-danger">*</span>
                            <input type="text" class="form-control   @error('account_number') is-invalid @enderror"
                                name="account_number" value="{{ old('account_number') }}" id="account_number"
                                placeholder="Account No">
                            @error('account_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cost">Cost</label><span class="text-danger">*</span>
                            <input type="text" class="form-control   @error('cost') is-invalid @enderror" name="cost"
                                value="{{ old('cost') }}" id="cost" placeholder="Cost">
                            @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input name="status" type="checkbox" value="1" class="form-check-input">
                                Status
                                <i class="input-helper"></i></label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('admin.account_gcashes.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection