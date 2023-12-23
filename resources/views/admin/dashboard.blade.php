@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card my-2">
        <div class="card-header">
            <h4>Statistics</h4>
        </div>
        <div class="card-body">
            <div class="row my-2">
                <div class="col-md-6">
                    <div class="container mt-5">
                        <canvas id="barChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="container mt-5">

                        <canvas id="lineChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card ">
        <div class="card-header">
            <h4>Statistics</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="container mt-5">
                        <canvas id="bookings" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var users = @json($users);
        var locations = @json($locations);
        var medicalRecords = @json($medicalRecords);

            var data = {
                labels: ['Total Users', 'Total Branches', 'Total Patients'],
                datasets: [{
                    label: 'Total Records',
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1,
                    data: [users, locations, medicalRecords], // Dummy data
                }]
            };

            // Bar chart
            var ctxBar = document.getElementById('barChart').getContext('2d');
            var barChart = new Chart(ctxBar, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var data2 = {
                labels: ['Total Users', 'Total Branches', 'Total Patients'],
                datasets: [{
                    label: 'Total Records',
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Point color for line chart
                    pointBorderWidth: 2, // Point border width for line chart
                    pointRadius: 5, // Point radius for line chart
                    pointHoverRadius: 8, // Point hover radius for line chart
                    data: [users, locations, medicalRecords], // Dummy data
                }]
            };

            // Line chart
            var ctxLine = document.getElementById('lineChart').getContext('2d');
            var lineChart = new Chart(ctxLine, {
                type: 'line',
                data: data2,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // bookings
            var months = @json($bookings->pluck('month'));
            var totals = @json($bookings->pluck('total'));

            // Define an array of 12 background colors
            var backgroundColors = [
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(240, 128, 128, 0.2)',
                'rgba(0, 128, 0, 0.2)',
                'rgba(255, 165, 0, 0.2)',
                'rgba(128, 128, 0, 0.2)',
                'rgba(128, 0, 128, 0.2)',
                'rgba(0, 0, 128, 0.2)'
            ];

            var bookingsData = {
                labels: months,
                datasets: [{
                    label: 'Total Booked',
                    backgroundColor: backgroundColors,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    data: totals,
                }]
            };

            // Bar chart
            var ctxBar = document.getElementById('bookings').getContext('2d');
            var bookingsBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: bookingsData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


        });
</script>
@endsection