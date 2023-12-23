@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4> Create Mapping</h4>
                        <a href="{{ route('admin.admin_branchs.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.admin_branchs.store')}}" method="POst"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="address">Address</label><span style="color:red">*</span>
                            <input type="text" class="form-control  @error('address') is-invalid @enderror"
                                name="address" value="{{ old('address') }}" id="address"
                                placeholder="Ex. 66 Callejon II Santa Cruz, Pasig City">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lat">Latitude</label><span style="color:red">*</span>
                            <input type="text" class="form-control @error('lat') is-invalid @enderror" name="lat"
                                value="{{ old('lat') }}" id="lat" placeholder="Ex. 16.1550">
                            @error('lat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="long">Longitude</label><span style="color:red">*</span>
                            <input type="text" class="form-control  @error('long') is-invalid @enderror" name="long"
                                value="{{ old('long') }}" id="long" placeholder="Ex. 119.9886">
                            @error('long')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="service" id="" class="form-control @error('service') is-invalid @enderror">
                                <option value="" selected disabled>Select Services</option>
                                @foreach ($services as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('service')
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
                        <a href="{{ route('admin.admin_branchs.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection