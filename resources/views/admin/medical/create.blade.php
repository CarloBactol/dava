@extends('layouts.admin')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4> Add Patient</h4>
                        <a href="{{ route('admin.medicals.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.medicals.store')}}" method="POst"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="vet_id">Veterinary</label>
                            {{-- <input type="hidden" value="{{$vet->id ?? ''}}" name="vet_id">
                            <input type="text" class="form-control  @error('firstname') is-invalid @enderror"
                                name="firstname" disabled value="{{'Dr. '.$vet->first_name . ' ' . $vet->last_name }}"
                                id="vet_id" placeholder="Firstname"> --}}
                            <select name="vet_id" id="" class="form-control">
                                <option value="" selected>Select Veterinarian...</option>
                                @foreach ($vet as $item)
                                <option value="{{ $item->id }}">{{ $item->first_name . ' ' . $item->last_name }}
                                </option>
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

                            <select name="animal_id" id=""
                                class="@error('animal_id') is-invalid @enderror form-control">
                                <option value="" selected>Select Patien...</option>
                                @foreach ($animal as $item )
                                @if ($item->owner->branch == Auth::user()->branch)
                                <option value="{{ $item->id }}">{{ $item->name . ' - ' .$item->owner->first_name . ' '
                                    . $item->owner->last_name
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
                                <option value="" selected disabled>Select...</option>
                                @foreach ($services as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
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
                            <input type="text" value=""
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
                            <input type="text" value="" class=" @error('cost') is-invalid @enderror form-control"
                                placeholder="Ex. 1000" name="cost">
                            @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" id="editor"
                                placeholder="Note."></textarea>
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