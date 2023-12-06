
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">
    @include('admin/sidebar')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
<div class="container">
    <h1 class="text-2xl font-bold mb-2 mt-3 welcome-message">List of Material Requested</h1>
<br><br>
<table class="table w-full border shadow">
    <thead>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Requested Date/Time</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($materialRequests as $request)
    <tr class="@if($request->status === 'accepted') table-success @elseif($request->status === 'declined') table-danger @endif">
        <td>{{ $request->name }}</td>
        <td>{{ $request->quantity }}</td>
        <td>{{ $request->amount }}</td>
        <td class="@if($request->status === 'accepted') status-accepted @endif">
            {{ $request->status }}
            @if($request->status === 'accepted')
            <i class="fas fa-check-circle text-success"></i>
            @elseif($request->status === 'declined')
            <i class="fas fa-times-circle text-danger"></i>
            @endif
        </td>
        <td>{{ $request->created_at }}</td>
        <td>
            <div class="btn-group" role="group">
                <form method="post" action="{{ route('admin.requests.accept', $request->id) }}">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-success">Accept</button>
                </form>
                <form method="post" action="{{ route('admin.requests.decline', $request->id) }}">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-danger">Decline</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
    </div>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- jQuery and Bootstrap JS -->
   

</body>
</html>
