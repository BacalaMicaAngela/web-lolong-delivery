@extends('pages.navigator')

@if ($data->userType == 0)
    @section('contentAdmin')
    <style>
        .schedule-label {
            font-size: 20px; /* Adjust the size as needed */
            font-weight: bold; /* Make the text bold */
        }
    </style>

    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <span class="schedule-label">LOLONG TRUCKING SERVICES EFFICIENCY DASHBOARD</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="barGraph" style="width:100%;max-width:600px;max-height:400px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="pieChart" style="width:100%;max-width:400px;max-height:400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="lineChart" style="width:100%;max-width:800px;max-height:400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Bar Graph
    let xValues = ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Oct", "Sept", "Nov", "Dec"];
    let yValues = [
        {{ $graphData[1] }},
        {{ $graphData[2] }},
        {{ $graphData[3] }},
        {{ $graphData[4] }},
        {{ $graphData[5] }},
        {{ $graphData[6] }},
        {{ $graphData[7] }},
        {{ $graphData[8] }},
        {{ $graphData[9] }},
        {{ $graphData[10] }},
        {{ $graphData[11] }},
        {{ $graphData[12] }}
    ];
    let barColors = [
        "#FFA07A",
        "#FFD700",
        "#98FB98",
        "#FF69B4",
        "#7B68EE",
        "#00CED1",
        "#F08080",
        "#9ACD32",
        "#00BFFF",
        "#FF6347",
        "#20B2AA",
        "#E6E6FA",
    ];

    new Chart("barGraph", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Total Monthly Delivery Record LTS (LOLONG TRUCKING SERVICES)"
            }
        }
    });

             // Pie Chart
    let xValuesP = ["Driver Records", "Truck Units Records", "Delivery Records", "Schedule Management", "Maintenance", "User List"];
    let yValuesP = [
        {{ $pieData[0] }},
        {{ $pieData[1] }},
        {{ $pieData[2] }},
        {{ $pieData[3] }},
        {{ $pieData[4] }},
        {{ $pieData[5] }},
    ];
    let barColorsP = [
        "#FF6384",
        "#36A2EB",
        "#FFCE56",
        "#66BB6A",
        "#FF8C00",
        "#8E44AD",
    ];

    new Chart("pieChart", {
        type: "doughnut",
        data: {
            labels: xValuesP,
            datasets: [{
                backgroundColor: barColorsP,
                data: yValuesP
            }]
        },
        options: {
            title: {
                display: true,
                text: "Total Record LTS (LOLONG TRUCKING SERVICES)"
            }
        }
    });

            // Line Chart (Example: Replace with your actual data)
            

            
        </script>

        
    </div>
    @endsection
@endif

@include('pages.Modals.manageProfile')
