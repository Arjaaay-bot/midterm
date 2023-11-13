<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .container {
            background-color: white;
            box-shadow: 4px 4px 20px #DADADA;
            padding: 10px;
            margin: 10px;
            width: 100%;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Apply the animation to the welcome message */
        .welcome-message {
            animation: fadeIn 1.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">
    @include('admin/sidebar')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <div class="container mx-auto mt-1 p-5">
        <h1 class="text-3xl font-bold mb-4 welcome-message">Welcome to Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-5">INVENTORY</h2>
                <p class="text-gray-600"><strong>Total Inventories: </strong><span id="totalInventories"></span></p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-5">REQUEST</h2>
                <p class="text-gray-600"><strong>Pending Request: </strong><span id="totalRequests"></span></p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-5">PROJECTS</h2>
                <p class="text-gray-600"><strong>Display Here The Total Projects: </strong><span id="totalInventories"></span></p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-5">ADD IF NEEDED</h2>
                <p class="text-gray-600">Content Here</p>
            </div>
        </div>
    </div>

     <main class="w-full flex-grow p-6 flex flex-wrap">
        <div class="w-full lg:w-1/2 xl:w-1/3 pr-0 lg:pr-2 mb-6">
            <h1 class="text-3xl text-black pb-6">Analytics</h1>
            <h1>My Analytics</h1>
            <canvas id="requestStatusChart"></canvas>
        </div>
        <div class="w-full lg:w-1/2 xl:w-2/3 pl-0 lg:pl-2 mb-6">
            <h1 class="text-3xl text-black pb-6 mt-6">Inventory Chart</h1>
            <canvas id="inventoryChart"></canvas>
        </div>
    </main>
    </div>
    </div>

    <script>
          document.addEventListener('DOMContentLoaded', function () {
        fetch('/total-requests')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalRequests').innerText = data.totalRequests;
            })
            .catch(error => console.error('Error:', error));
    });
        document.addEventListener('DOMContentLoaded', function () {
        fetch('/total-inventories')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalInventories').innerText = data.totalInventories;
            })
            .catch(error => console.error('Error:', error));
        });
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/chart-data')
                .then(response => response.json())
                .then(data => {
                    var ctx1 = document.getElementById('requestStatusChart').getContext('2d');
                    var myPieChart = new Chart(ctx1, {
                        type: 'pie',
                        data: {
                            labels: ['Waiting for Approval', 'Accepted', 'Declined'],
                            datasets: [{
                                data: [data.waiting, data.accepted, data.declined],
                                backgroundColor: ['#FFCC00', '#28A745', '#DC3545'],
                            }],
                        },
                    });
                })
                .catch(error => console.error('Error fetching request status chart data:', error));
            fetch('/chart-inventory')
                .then(response => response.json())
                .then(data => {
                    var ctx2 = document.getElementById('inventoryChart').getContext('2d');
                    var myBarChart = new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Inventory Quantities',
                                data: data.quantities,
                                backgroundColor: '#007BFF',
                            }],
                        },
                    });
                })
                .catch(error => console.error('Error fetching inventory chart data:', error));
        });
    </script>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
