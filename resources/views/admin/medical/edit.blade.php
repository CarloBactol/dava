@extends('layouts.admin')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4>Edit Patient</h4>
                        <a href="{{ route('admin.medicals.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.medicals.update', $med->id)}}" method="POst"
                        enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="vet_id">Veterinary</label>
                            <select name="vet_id" id="" class="form-control">
                                <option value="" selected>Select Veterinarian...</option>
                                @foreach ($vet as $item)
                                <option value="{{ $item->id }}" {{ $med->vet_id == $item->id ? 'selected' : '' }}>{{
                                    $item->email }}</option>
                                @endforeach
                            </select>
                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lname">Patient Name</label>



                            <select name="animal_id" id="" disabled
                                class="@error('animal_id') is-invalid @enderror form-control">
                                @foreach ($animal as $item )
                                @if ($item->owner->branch == Auth::user()->branch)
                                <option value="{{ $item->id }} {{ $med->animal_id == $item->id ? 'selected' : '' }}">{{
                                    $item->name . ' - ' .$item->owner->email
                                    }}
                                </option>
                                @endif

                                @endforeach
                            </select>
                            @error('animal_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="diagnosis">Procedure</label>
                            <select name="procedure" id=""
                                class="@error('procedure') is-invalid @enderror form-control">
                                <option value="{{ $med->procedure }}" selected>{{ $med->procedure }}</option>
                                @foreach ($services as $key => $value)
                                @if ($value->name != $med->procedure)
                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                @endif
                                @endforeach

                            </select>
                            @error('procedure')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type_of_procedure">Type of Procedure</label>
                            <input type="text" value="{{ $med->type_of_procedure }}"
                                class=" @error('type_of_procedure') is-invalid @enderror form-control"
                                placeholder="Ex. Dental Cleaning" name="type_of_procedure">
                            @error('type_of_procedure')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cost">Cost (PHP)</label>
                            <input type="text" value="{{ $med->cost }}"
                                class=" @error('cost') is-invalid @enderror form-control" placeholder="Ex. 1000"
                                name="cost">
                            @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" id="editor"
                                placeholder="Note.">{!! $med->notes !!}</textarea>
                            @error('notes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('admin.medicals.index') }}" class="btn btn-light">Cancel</a>
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