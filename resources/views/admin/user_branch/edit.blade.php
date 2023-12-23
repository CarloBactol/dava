@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4> Edit Employee Profile</h4>
                        <a href="{{ route('admin.user_branches.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.user_branches.update', $user->id)}}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="first_name">First name</label><span style="color:red;">*</span>
                            <input type="text" class="form-control  @error('first_name') is-invalid @enderror"
                                name="first_name" value="{{ $user->first_name }}" placeholder="Ex. Carlo">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last name</label><span style="color:red;">*</span>
                            <input type="text" class="form-control  @error('last_name') is-invalid @enderror"
                                name="last_name" value="{{ $user->last_name }}" id="last_name" placeholder="Ex. Pamor">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label><span style="color:red;">*</span>
                            <input type="text" class="form-control  @error('phone_number') is-invalid @enderror"
                                name="phone_number" value="{{ $user->phone_number }}" placeholder="Ex. 09513384264">
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label><span style="color:red;">*</span>
                            <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email"
                                value="{{ $user->email }}" id="email" placeholder="Ex. carlopamor@email.com">
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
                                <option value="{{ $user->branch }}" selected>{{
                                    $user->branch }}</option>
                                @foreach ($location as $item )
                                @if ($item->address != $user->branch)
                                <option value="{{ $item->address }}">{{ $item->address }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('branch')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="hidden" value="{{ $user->password }}" name="password">
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="status" {{ $user->status ==
                                1 ? 'checked' : '' }} value="1">
                                Status
                                <i class="input-helper"></i></label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{ route('admin.user_branches.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection