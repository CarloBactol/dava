@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4>User Appointment Details</h4>
                        {{-- <a href="{{ route('admin.owners.index') }}" class="btn btn-md btn-info">Back</a> --}}
                        <a href="{{ route('admin.user_appoitments.index') }}"
                            class="btn btn-inverse-primary btn-rounded btn-icon">
                            <i class="ti-arrow-left"></i>
                        </a>
                    </div>
                    <form class="forms-sample" action="{{ route('admin.user_appoitments.update', $userBook->id)}}"
                        method="Post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" disabled class="form-control " value="{{ $userBook->email }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Apoinment Type</label>
                                    <input type="text" disabled class="form-control " value="{{ $userBook->type }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" disabled class="form-control " value="{{ $userBook->address }}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Branch</label>
                                    <input type="text" disabled class="form-control " value="{{ $userBook->branch }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Services Name</label>
                                    <input type="text" disabled class="form-control " value="{{ $userBook->services }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Appointment Date</label>
                                    <input type="date" disabled class="form-control " value="{{ $userBook->date }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Start Time</label>
                                    <input type="time" disabled class="form-control" value="{{ $userBook->start }}">
                                </div>
                            </div>
                            {{-- <div class="col-4">
                                <div class="form-group">
                                    <label for="">End</label>
                                    <input type="time" disabled class="form-control " value="{{ $userBook->end }}">
                                </div>
                            </div> --}}
                        </div>

                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control
                                 @if($userBook->status == 'Canceled')
                                 is-invalid
                                 @elseif ($userBook->status == 'Completed')
                                 is-valid
                                  @endif" {{ $userBook->status == 'Pending' ? '' : 'disabled' }}>
                                <option value="Pending" {{ $userBook->status == 'Pending' ? 'selected' : ''}}
                                    class="form-control">Pending</option>
                                <option value="Completed" {{ $userBook->status == 'Completed' ? 'selected' : ''}}
                                    class="form-control">Completed</option>nj
                                {{-- <option value="Approved" {{ $userBook->status == 'Approved' ? 'selected' : ''}}
                                    class="form-control">Approved</option> --}}
                                <option value="Canceled" {{ $userBook->status == 'Canceled' ? 'selected' :
                                    ''}}
                                    class="form-control">Canceled</option>
                            </select>
                            @if($userBook->status == 'Canceled')
                            <span class="invalid-feedback" role="alert">
                                <strong>Appointments was canceled cannot be update.</strong>
                            </span>m
                            @elseif ($userBook->status == 'Completed')
                            <span class="valid-feedback" role="alert">
                                <strong>Appointments was completed cannot be update.</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control" {{ $userBook->status == 'Pending' ?
                                '' : 'disabled' }}
                                placeholder="Message">{{ $userBook->message ?? '' }} </textarea>


                        </div>

                        <button type="submit" class="btn btn-primary me-2" {{ $userBook->status == 'Pending' ?
                            '' : 'disabled'}}>Submit</button>
                        <a href="{{ route('admin.user_appoitments.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection