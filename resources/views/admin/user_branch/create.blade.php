@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4> Add Employee</h4>
                        <a href="{{ route('admin.user_branches.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.user_branches.store')}}" method="POst"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="first_name">First name</label><span style="color:red;">*</span>
                            <input type="text" class="form-control  @error('first_name') is-invalid @enderror"
                                name="first_name" value="{{ old('first_name') }}" placeholder="Ex. Carlo">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last name</label><span style="color:red;">*</span>
                            <input type="text" class="form-control  @error('last_name') is-invalid @enderror"
                                name="last_name" value="{{ old('last_name') }}" id="last_name" placeholder="Ex. Pamor">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label><span style="color:red;">*</span>
                            <input type="text" class="form-control  @error('phone_number') is-invalid @enderror"
                                name="phone_number" value="{{ old('phone_number') }}" id="phone_number"
                                placeholder="Ex. 09513384264">
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label><span style="color:red;">*</span>
                            <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" id="email" placeholder="Ex. carlopamor@email.com">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="branch">Branch</label><span style="color:red;">*</span>
                            <select name="branch" id="" class="form-control  @error('branch') is-invalid @enderror"
                                name="Branch">
                                <option disabled selected value="">Select Branch</option>
                                @foreach ($location as $item)
                                <option value="{{ $item->address }}">{{ $item->address }}</option>
                                @endforeach
                            </select>
                            @error('branch')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label><span style="color:red;">*</span>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" id="password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label><span style="color:red;">*</span>
                            <input type="password"
                                class="form-control  @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                id="password_confirmation" placeholder="Confirm password">
                            @error('password_confirmation')
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
                        <a href="{{ route('admin.user_branches.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection