@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 " style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4> Add Owner</h4>

                        <a href="{{ route('admin.admin_owners.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.admin_owners.store')}}" method="POst"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="branch">Branch</label>
                            <select name="branch" class="form-control  @error('branch') is-invalid @enderror"
                                name="Branch">
                                <option disabled selected value="">Select Branch</option>
                                @foreach ($location as $item)
                                <option value="{{ $item->address }}" {{ Auth::user()->branch == $item->address ?
                                    'selected' : '' }}>{{ $item->address }}</option>

                                @endforeach
                            </select>
                            @error('branch')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <select name="email" id="" class="form-control  @error('email') is-invalid @enderror"
                                name="email">
                                <option disabled selected value="">Select Owner</option>
                                @foreach ($users as $item)
                                <option value="{{ $item->email }}">{{ $item->email }}</option>
                                @endforeach
                            </select>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" id="email" placeholder="Email Address">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control  @error('first_name') is-invalid @enderror"
                                name="first_name" value="{{ old('first_name') }}" id="fname" placeholder="First Name">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name" value="{{ old('last_name') }}" id="lname" placeholder="Last Name">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="address">Address</label>
                            <input type="text" class="form-control  @error('address') is-invalid @enderror"
                                name="address" value="{{ old('address') }}" id="address" placeholder="Address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" value="{{ old('phone_number') }}"
                                class="form-control  @error('phone_number') is-invalid @enderror" name="phone_number"
                                id="phone_number" placeholder="Phone number">
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" value="1" name="status" class="form-check-input">
                                Status
                                <i class="input-helper"></i></label>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('admin.admin_owners.index') }}" class="btn btn-light">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection