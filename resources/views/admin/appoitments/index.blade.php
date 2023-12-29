@extends('layouts.admin')
@section('content')

<div class="container-fluid">
  <div class="row">

    <div class="col-md-7">
      <div id="calendar"></div>

      <!-- Modal -->
      <div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Appointment Details</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modalBody">
              <!-- Content will be dynamically populated here -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-2">
            <h4 class="card-title">Appointment Status</h4>
            {{-- <a title="new" href="{{ route('admin.appoitments.create') }}" class="btn btn-sm btn-info py-2 mb-2">Add
              new</a> --}}
          </div>
          <div class="table-responsive">
            <table class="table table-hover" id="myTable">
              <thead>
                <tr>
                  <th>Branch</th>
                  <th></th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bookings as $item)
                <tr>
                  <td>{{ Str::ucfirst($item->branch) }}</td>
                  <td>{{ $item->created_at->diffForHumans() }}</td>
                  <td>
                    @if ($item->status == 'Pending')
                    <label class="badge badge-warning">Pending</label>
                    @elseif ($item->status == 'Completed')
                    <label class="badge badge-success">Completed</label>
                    @elseif ($item->status == 'Canceled')
                    <label class="badge badge-danger">Canceled</label>
                    @endif
                  </td>
                  <td>
                    {{-- <a href="{{ route('admin.user_appoitments.show', $item->id) }}"
                      class="btn btn-primary btn-sm me-1 btn-icon float-start">
                      <i class="ti-eye"></i>
                    </a> --}}
                    <a href="{{ route('admin.user_appoitments.edit', $item->id) }}"
                      class="btn btn-primary btn-sm me-1 btn-icon float-start">
                      <i class="ti-eye"></i>
                    </a>

                    <form method="post" action="{{ route('admin.user_appoitments.destroy', $item->id) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm  btn-icon">
                        <i class="ti-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
  // Your dynamic data (replace this with your actual data)
  $('#myTable').DataTable();

  var jsonData = @json($bookings);


    var eventData = [];
    jsonData.forEach(function(appointment) {
        var pStart = appointment.date+'T'+appointment.start
        var pEnd = appointment.date+'T'+appointment.end
        eventData.push({
          title: appointment.services,
          branch: appointment.branch,
          date: appointment.date,
          start: pStart,
          end: pEnd,
          type: appointment.type,
          email: appointment.email,
          address: appointment.address,
          status: appointment.status,
          className: 'appointment',
          message: appointment.message,
        });
      });
      console.log(eventData)

//   var eventData = [
//     {
//       title: 'Appointment 1',
//       start: '2023-11-01T14:00:00',
//       end: '2023-11-01T16:00:00',
//       className: 'appointment',
//       type: 'Walk-in',
//       email: 'user@email.com',
//       address: 'Pasig City',
//       status: 'Approved'
//     },
//     {
//       title: 'Appointment 1',
//       start: '2023-11-01T17:00:00',
//       end: '2023-11-01T18:00:00',
//       className: 'appointment',
//       type: 'Walk-in',
//       email: 'user2@email.com',
//       address: 'Pasig2 City',
//       status: 'Approved2'
//     },
//     {
//       title: 'Appointment 2',
//       start: '2023-11-05T10:30:00',
//       end: '2023-11-05T12:00:00',
//       className: 'appointment',
//       type: 'Online',
//       email: 'anotheruser@email.com',
//       address: 'Makati City',
//       status: 'Pending'
//     },
//     // Add more appointment data as needed
//     {
//       title: 'Holiday 1',
//       start: '2023-11-04T09:00:00',
//       end: '2023-11-04T17:00:00',
//       className: 'holiday'
//     },
//     {
//       title: 'Holiday 2',
//       start: '2023-11-09T13:00:00',
//       end: '2023-11-09T15:30:00',
//       className: 'holiday'
//     },
//     // Add more holiday data as needed
//     {
//       title: 'Dental Care - Alaminos City',
//       start: '2023-12-11T14:00:00',
//       end: '2023-12-11T15:00:00',
//       className: 'appointment',
//       type: 'Walk-in',
//       email: 'alaminosuser@email.com',
//       address: 'Alaminos City',
//       status: 'Approved'
//     }
//   ];

  // Initialize FullCalendar
  $(document).ready(function () {
    // Initialize FullCalendar
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      events: eventData,
      eventRender: function (event, element) {
        // Set the background color based on the status
        if (event.status === 'Canceled') {
          element.css('background-color', 'red'); // Red for canceled events
        } else if (event.status === 'Completed') {
          element.css('background-color', 'green'); // Green for completed events
        } else if (event.status === 'Pending') {
          element.css('background-color', '#b8b806d5'); // Light pink for pending events
        }
      },
      eventClick: function (calEvent, jsEvent, view) {
        // Display appointment details in modal with AM/PM format use hh:mm:ss A
        $('#modalBody').html('<p><strong>Service Name:</strong> ' + calEvent.title + '</p>' +
          '<p><strong>Branch:</strong> ' + calEvent.branch + '</p>' +
          '<p><strong>Date:</strong> ' + moment(calEvent.date).format('YYYY-MM-DD') + '</p>' +
          '<p><strong>Start Time:</strong> ' + moment(calEvent.start).format('hh:mm:ss A') + '</p>' +
          '<p><strong>End Time:</strong> ' + moment(calEvent.end).format('hh:mm:ss A') + '</p>' +
          '<p><strong>Type:</strong> ' + calEvent.type + '</p>' +
          '<p><strong>Email:</strong> ' + calEvent.email + '</p>' +
          '<p><strong>Address:</strong> ' + calEvent.address + '</p>' +
          '<p><strong>Status:</strong> ' + calEvent.status + '</p>' +
          '<p><strong>Message:</strong> ' + calEvent.message + '</p>');
        $('#appointmentModal').modal('show');
      }
    });
  });
});
</script>


<style>
  .holiday {
    background-color: #aaf;
  }

  .canceled {
    background-color: red;
  }

  .completed {
    background-color: green;
  }

  .pending {
    background-color: #b8b806d5;
  }
</style>

@endsection