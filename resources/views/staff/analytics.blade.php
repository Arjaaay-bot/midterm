
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Report Generation</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="./images/ArchDevLogo.png">
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
        <h1 class="text-2xl font-bold">Report Generation</h1>
    </div>
    <form method="get" action="{{ route('analytics') }}" class="flex space-x-4">
        @csrf
        <div class="flex items-center">
            <h1 class="text-1xl font-bold">Select Month</h1>
            <select name="selected_month" id="selected_month" class="ml-2 p-2 border rounded-md">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $i == $selectedMonth ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Generate</button>
        <button type="button" id="printBtn" class="bg-green-500 text-white px-4 py-2 rounded-md">Print</button>
    </form><br>
    </form>
    
    <div class="overflow-x-auto mt-4">
    <table class="table w-full border shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">Inventory Name</th>
                <th class="py-2 px-4 border-b">Quantity</th>
                <th class="py-2 px-4 border-b">Amount</th>
            </tr>
        </thead>
        <tbody>
            @if (count($inventoryItems) > 0)
                @foreach($inventoryItems as $item)
                <tr data-id="{{ $item->id }}" class="{{ $item->quantity <= 10 ? 'bg-red-100' : '' }}">
                        <td class="py-2 px-4 border-b">{{ $item->name }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($item->quantity <= 10)
                                <span class="text-red-500">{{ $item->quantity }}</span>
                                <p class="text-red-500">Low quantity warning!</p>
                            @else
                                {{ $item->quantity }}
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">₱{{ $item->amount }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td class="py-2 px-4 border-b font-bold">Total Amount:</td>
                    <td class="py-2 px-4 border-b font-bold">₱{{ $totalAmount }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="4" class="py-2 px-4 border-b">No data available for the selected month.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>  
</div>
</div>
</div>  
<script>
    document.getElementById('printBtn').addEventListener('click', function () {
        const tableContent = document.querySelector('table').outerHTML;
        const selectedMonthValue = document.getElementById('selected_month').value;
        const selectedMonthText = document.getElementById('selected_month').options[document.getElementById('selected_month').selectedIndex].text;
        const selectedMonth = selectedMonthText ? selectedMonthText : selectedMonthValue;
        const printWindow = window.open('', '_blank');

        printWindow.document.write('<html><head><title>Print</title></head><body>');
        printWindow.document.write('<style>' +
            'body { font-family: "Karla", sans-serif; margin: 20px; }' +
            'h1, h2, p { margin-bottom: 10px; }' +
            'table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }' +
            'th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }' +
            'th { background-color: #f2f2f2; }' +
            '</style>');
        printWindow.document.write('<h1>A-King Construction Inventory System</h1>');
        printWindow.document.write('<h2>Report Generation on the month of ' + selectedMonth + '</h2>');
        printWindow.document.write(tableContent);
        printWindow.document.write('<p>Generated By: {{ Auth::user()->name }}</p>');
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.print();
    });
</script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
