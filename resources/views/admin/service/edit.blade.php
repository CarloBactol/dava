@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4> Edit Services</h4>
                        {{-- <a href="{{ route('admin.owners.index') }}" class="btn btn-md btn-info">Back</a> --}}
                        <a href="{{ route('admin.admin_services.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.admin_services.update', $service->id)}}"
                        method="POst" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")
                        <div class="form-group">
                            <label for="name">Name</label><span style="color:red">*</span>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                                value="{{ Str::ucfirst($service->name) }}" id="name" placeholder="Ex. Dental Care">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Description</label><span style="color:red">*</span>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                id="editor" cols="92" rows="10"
                                placeholder="Ex. Dental cleanings and treatments for oral health issues in pets.">{{ Str::ucfirst($service->description) }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="status" {{ $service->status ==
                                1 ? 'checked' : '' }} value="1">
                                Status
                                <i class="input-helper"></i></label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('admin.admin_services.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
@endsection