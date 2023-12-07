
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
@include('admin/sidebar')
<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <div class="container">
<div class="flex justify-between items-center mt-8">
        <h1 class="text-2xl font-bold">Construction Materials Inventory</h1>
        <button id="addInventoryButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold mb-3 py-2 px-4 rounded flex items-center">
            <i class="fas fa-plus-circle text-xl mr-2"></i> Add Inventory
        </button>
    </div>
        <div class="overflow-x-auto">
            <table id="myDataTable" class="table w-full border shadow">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Quantity</th>
                        <th class="py-2 px-4 border-b">Amount</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
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
                            <td class="py-2 px-4 border-b">{{ $item->amount }}</td>
                            <td class="py-2 px-4 border-b flex items-center">
                                <a href="#" class="bg-blue-500 text-white py-1 px-2 rounded-l-full text-sm focus:outline-none focus:shadow-outline-blue active:bg-blue-800 flex-shrink-0 edit-item" data-id="{{ $item->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="bg-red-500 text-white py-1 px-2 text-sm focus:outline-none focus:shadow-outline-blue active:bg-blue-800 flex-shrink-0 delete-item" data-id="{{ $item->id }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="#" class="bg-green-500 text-white py-1 px-2 rounded-r-full text-sm focus:outline-none focus:shadow-outline-blue active:bg-blue-800 flex-shrink-0 reduce-quantity" data-id="{{ $item->id }}">
                                    <i class="fas fa-minus"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

        <!-- Reduce Quantity Modal -->
    <div class="modal fade" id="reduceQuantityModal" tabindex="-1" role="dialog" aria-labelledby="reduceQuantityModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reduceQuantityModalLabel">Reduce Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="reduceQuantityInput">Enter Quantity to Reduce:</label>
                    <input type="number" id="reduceQuantityInput" class="form-control" min="1" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmReduceQuantity">Reduce Quantity</button>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteItemModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden">
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Delete Inventory Item</p>
                    <button id="closeDeleteModal" class="modal-close cursor-pointer z-50">
                        <i class="fas fa-times text-gray-500"></i>
                    </button>
                </div>
                <div class="my-5">
                    <p>Are you sure you want to delete this item?</p>
                </div>
                <div class="flex justify-end pt-2">
                    <button id="confirmDelete" class="modal-close px-4 bg-red-500 p-2 rounded-lg text-white hover:bg-red-400">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div id="editItemModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden">
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Edit Inventory Item</p>
                    <button id="closeEditModal" class="modal-close cursor-pointer z-50">
                        <i class="fas fa-times text-gray-500"></i>
                    </button>
                </div>
                <form method="POST" data-action="{{ route('update-inventory', ['id' => ':id']) }}" id="editItemForm">
                    @csrf
                    @method('PUT') 
                    <input type="hidden" name="item_id" id="editItemId">
                    <div class="my-5">
                        <label for="editName" class="text-gray-600">Name</label>
                        <input type="text" name="name" id="editName" class="w-full p-2 border rounded">
                    </div>
                    <div class="my-5">
                        <label for="editQuantity" class="text-gray-600">Quantity</label>
                        <input type="number" name="quantity" id="editQuantity" class="w-full p-2 border rounded">
                    </div>
                    <div class="my-5">
                        <label for="editAmount" class="text-gray-600">Amount</label>
                        <input type="text" name="amount" id="editAmount" class="w-full p-2 border rounded">
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="modal-close px-4 bg-blue-500 p-2 rounded-lg text-white hover-bg-blue-400">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="inventoryModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden">
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Add Inventory</p>
                    <button id="closeModal" class="modal-close cursor-pointer z-50">
                        <i class="fas fa-times text-gray-500"></i>
                    </button>
                </div>
                <form method="POST" action="{{ route('add-inventory') }}">
                    @csrf
                    <div class="my-5">
                        <label for="name" class="text-gray-600">Name</label>
                        <input type="text" name="name" id="name" class="w-full p-2 border rounded">
                    </div>
                    <div class="my-5">
                        <label for="quantity" class="text-gray-600">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="w-full p-2 border rounded">
                    </div>
                    <div class="my-5">
                        <label for="amount" class="text-gray-600">Amount</label>
                        <input type="text" name="amount" id="amount" class="w-full p-2 border rounded">
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="modal-close px-4 bg-blue-500 p-2 rounded-lg text-white hover:bg-blue-400">Add Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


<script>
    document.getElementById("addInventoryButton").addEventListener("click", function() {
        document.getElementById("inventoryModal").classList.remove("hidden");
    });

    document.getElementById("closeModal").addEventListener("click", function() {
        document.getElementById("inventoryModal").classList.add("hidden");
    });

    document.querySelectorAll(".edit-item").forEach(function(editButton) {
        editButton.addEventListener("click", function(event) {
        event.preventDefault();
        var itemId = event.currentTarget.getAttribute("data-id");
        var itemRow = document.querySelector(`tr[data-id="${itemId}"]`);
        var itemName = itemRow.querySelector("td:nth-child(1)").innerText;
        var itemQuantity = itemRow.querySelector("td:nth-child(2)").innerText;
        var itemAmount = itemRow.querySelector("td:nth-child(3)").innerText;

        document.getElementById("editItemId").value = itemId;
        document.getElementById("editName").value = itemName;
        document.getElementById("editQuantity").value = itemQuantity;
        document.getElementById("editAmount").value = itemAmount;

        var editItemForm = document.getElementById("editItemForm");
        var editRoute = editItemForm.getAttribute("data-action");
        editRoute = editRoute.replace(":id", itemId);
        editItemForm.setAttribute("action", editRoute);

        document.getElementById("editItemModal").classList.remove("hidden");
    });
});

    document.querySelectorAll(".delete-item").forEach(function (deleteButton) {
        deleteButton.addEventListener("click", function (event) {
            event.preventDefault();
            var itemId = event.currentTarget.getAttribute("data-id");
            var itemRow = document.querySelector(`tr[data-id="${itemId}"]`);
            document.getElementById("deleteItemModal").classList.remove("hidden");
            document.getElementById("confirmDelete").setAttribute("data-id", itemId);
        });
    });


    document.getElementById("confirmDelete").addEventListener("click", function (event) {
        var itemId = event.currentTarget.getAttribute("data-id");
        var itemRow = document.querySelector(`tr[data-id="${itemId}"]`);
        $.ajax({
            type: "DELETE",
            url: `/inventory/${itemId}`,
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function () {
                itemRow.remove();
                document.getElementById("deleteItemModal").classList.add("hidden");
            },
            error: function () {
                alert("Failed to delete the item.");
                document.getElementById("deleteItemModal").classList.add("hidden");
            }
    });
});
        document.getElementById("closeDeleteModal").addEventListener("click", function () {
            document.getElementById("deleteItemModal").classList.add("hidden");
});

document.querySelectorAll(".reduce-quantity").forEach(function (reduceButton) {
        reduceButton.addEventListener("click", function (event) {
            event.preventDefault();
            var itemId = event.currentTarget.getAttribute("data-id");
            $('#reduceQuantityModal').modal('show');
            $('#reduceQuantityModal').data('item-id', itemId);
        });
    });

    $('#confirmReduceQuantity').on('click', function () {
        var itemId = $('#reduceQuantityModal').data('item-id');
        var reduceQuantity = $('#reduceQuantityInput').val();

        $.ajax({
            type: "PUT",
            url: `/inventory/${itemId}/reduce-quantity`,
            data: {
                _token: "{{ csrf_token() }}",
                reduceQuantity: reduceQuantity,
            },
            success: function (response) {
                if (response.success) {
                    var itemRow = document.querySelector(`tr[data-id="${itemId}"]`);
                    var newQuantity = response.newQuantity;
                    itemRow.querySelector("td:nth-child(2)").innerText = newQuantity;
                    $('#reduceQuantityModal').modal('hide');
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Failed to reduce the quantity.");
            }
        });
    });
    document.querySelectorAll(".show-notifications").forEach(function (notificationButton) {
    notificationButton.addEventListener("click", function () {
    });
    });
    document.getElementById("closeEditModal").addEventListener("click", function() {
        document.getElementById("editItemModal").classList.add("hidden");
    });
    $(document).ready(function () {
            $('#myDataTable').DataTable();
    });

</script>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>
</html>
