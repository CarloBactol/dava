@extends('layouts.veterinary')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4>Add medecine</h4>
                        <a href="{{ route('veterinary.medecine_inventories.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample"
                        action="{{ route('veterinary.medecine_inventories.update', $medecine->id)}}" method="Post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label><span class="text-danger">*</span>
                            <input type="text" class="form-control   @error('name') is-invalid @enderror" name="name"
                                value="{{  $medecine->name }}" id="name" placeholder="Name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label><span class="text-danger">*</span>
                            <input type="number" class="form-control   @error('quantity') is-invalid @enderror"
                                name="quantity" value="{{  $medecine->quantity }}" id="quantity" placeholder="quantity">
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                id="editor" placeholder="Note.">{!! $medecine->description !!}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" name="status" value="1" class="form-check-input" {{
                                    $medecine->status ==
                                1 ? 'checked' : '' }} value="1">
                                Status
                                <i class="input-helper"></i></label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('veterinary.medecine_inventories.index') }}" class="btn btn-light">Cancel</a>
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