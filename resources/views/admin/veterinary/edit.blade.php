@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4> Edit Veterinary</h4>
                        {{-- <a href="{{ route('admin.owners.index') }}" class="btn btn-md btn-info">Back</a> --}}
                        <a href="{{ route('admin.admin_veterinaries.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.admin_veterinaries.update', $veterinary->id)}}"
                        method="POst" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="fname">First Name</label><span style="color:red">*</span>
                            <input type="text" class="form-control  @error('firstname') is-invalid @enderror"
                                name="firstname" value="{{ Str::ucfirst($veterinary->first_name) }}" id="fname"
                                placeholder="Ex. Willy">
                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label><span style="color:red">*</span>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                name="lastname" value="{{ Str::ucfirst($veterinary->last_name) }}" id="lname"
                                placeholder="Ex. Ong">
                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="specialization">Specialization</label><span style="color:red">*</span>
                            <select name="specialize_id"
                                class="form-control @error('specialization') is-invalid @enderror">
                                <option value="{{ $veterinary->specialize_id }}" selected>{{
                                    $veterinary->specialization->title }}</option>
                                @foreach ($specialization as $item)
                                @if ($veterinary->specialization->title != $item->title)
                                <option value="{{ $item->id }}">{{ Str::upper($item->title) }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('specialization')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}

                        <div class="form-group">
                            <input type="hidden" value="2" id="category_id">
                            <p>SPECIALIZE</p>
                            @foreach ($specialization as $item)
                            <div class="row d-flex justify-content-between">
                                <div class="">
                                    <input class="ml-3" type="checkbox"
                                        class="@error('specialize') is-invalid @enderror" value="{{ $item->title }}"
                                        id="add_ons_id" name="specialize[]" {{ strpos($veterinary->specialize_id,
                                    $item->title) !== false ? 'checked' : '' }}
                                    />
                                    <span class="" for="{{ $item->title }}">{{ $item->title }}</span>
                                </div>
                            </div>
                            @endforeach
                            @error('specialize')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label><span style="color:red">*</span>
                            <input type="text" class="form-control  @error('address') is-invalid @enderror"
                                name="address" value="{{ Str::upper($veterinary->address) }}" id="address"
                                placeholder="Ex. Purok 6 Santa Cruz, Pasig City">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label><span style="color:red">*</span>
                            <input type="text" value="{{$veterinary->phone_number }}"
                                class="form-control  @error('phone_number') is-invalid @enderror" name="phone_number"
                                id="phone_number" placeholder="Ex. 09513384264">
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label><span style="color:red">*</span>
                            <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                                id="exampleInputEmail1" value="{{ $veterinary->email }}"
                                placeholder="Ex. willyong@email.com">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="branch">Branch</label><span style="color:red">*</span>
                            <select name="branch" id="" class="form-control  @error('branch') is-invalid @enderror"
                                name="Branch">
                                <option disabled selected value="">Select Branch</option>
                                <option value="{{ $veterinary->branch }}" selected>{{
                                    $veterinary->branch }}</option>
                                @foreach ($location as $item )
                                @if ($veterinary->branch != $item->address)
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

                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="status" {{ $veterinary->status ==
                                1 ? 'checked' : '' }} value="1">
                                Status
                                <i class="input-helper"></i></label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('admin.admin_veterinaries.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection