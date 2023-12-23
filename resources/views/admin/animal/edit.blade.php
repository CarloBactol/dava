@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4> Add Animal</h4>
                        {{-- <a href="{{ route('admin.owners.index') }}" class="btn btn-md btn-info">Back</a> --}}
                        <a href="{{ route('admin.admin_animals.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.admin_animals.update', $animal->id)}}"
                        method="POst" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
                        <div class="form-group">
                            <label for="species">Species</label><span style="color:red">*</span>
                            <input type="text" class="form-control  @error('species') is-invalid @enderror"
                                name="species" value="{{ $animal->species }}" id="species" placeholder="Ex. Dog">
                            @error('species')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="breed">Breed</label><span style="color:red">*</span>
                            <input type="text" class="form-control @error('breed') is-invalid @enderror" name="breed"
                                value="{{  $animal->breed }}" id="breed" placeholder="Ex. Aspin">
                            @error('breed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label><span style="color:red">*</span>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                                value="{{  $animal->name }}" id="name" placeholder="Ex. Baldo">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label><span style="color:red">*</span>
                            <input type="date" value="{{  $animal->date_of_birth }}"
                                class="form-control  @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                                id="date_of_birth" placeholder="03/10/2023">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gender</label><span style="color:red">*</span>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="Male" {{ $animal->gender == "Male" ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $animal->gender == "Female" ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="color">Color</label><span style="color:red">*</span>
                            <input type="text" class="form-control  @error('color') is-invalid @enderror" name="color"
                                value="{{ $animal->color }}" id="color" placeholder="Ex. Orange">
                            @error('color')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Owner</label><span style="color:red">*</span>
                            <select name="owner" class="form-control @error('owner') is-invalid @enderror">
                                @foreach ($users as $item)
                                <option value="{{ $item->id }}" {{ $item->email == $animal->owner->email ? 'selected' :
                                    '' }}>{{ Str::upper($item->first_name). ' '. Str::upper($item->last_name)}}</option>
                                @endforeach
                            </select>
                            @error('owner')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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