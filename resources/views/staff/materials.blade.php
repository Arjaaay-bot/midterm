
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff View Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

   <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .container {
            background-color: white;
            box-shadow: 4px 4px 20px #DADADA;
            padding: 10px;
            margin: 10px;
            width: 100%;
        }
     
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">
@include('staff/sidebar')
  
<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <div class="container">
        <div class="flex justify-between items-center mt-4 mb-3">
            <h1 class="text-2xl font-bold">Construction Materials Inventory</h1>
        </div>

            <table id="example" class="cell-border" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    
                    </tr>
                </thead>

            <tbody>
                <tr>
                    @foreach($inventoryItems as $item)
                        <td>{{ $item->name }}</td>
                        <td> @if ($item->quantity <= 10)
                            <span class="text-red-500">{{ $item->quantity }}</span>
                            <p class="text-red-500">Low quantity warning!</p>
                            @else
                            {{ $item->quantity }}
                            @endif</td>
                        <td>{{ $item->amount }}</td>
                </tr>
                    @endforeach
            </tbody>

                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</body>
</html>
