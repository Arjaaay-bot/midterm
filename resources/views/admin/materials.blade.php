
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
     
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">
@include('admin/sidebar')

    <div class="p-4">
        <button id="addInventoryButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Inventory
        </button>   
    </div>
    

   <!-- Display Materials List -->
<div class="materials-list">
    <h1>Construction Materials Inventory</h1><br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventoryItems as $item)
                <tr data-id="{{ $item->id }}">
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>
                        <a href="#" class="edit-item" data-id="{{ $item->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="delete-item" data-id="{{ $item->id }}">
                            <i class="fas fa-trash"></i>
                        </a>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Delete Item Modal -->
<div id="deleteItemModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden">
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Delete Inventory Item</p>
                <button id="closeDeleteModal" class="modal-close cursor-pointer z-50">
                    <i class="fas fa-times text-gray-500"></i>
                </button>
            </div>
            <!-- Modal Body - Confirmation message -->
            <div class="my-5">
                <p>Are you sure you want to delete this item?</p>
            </div>
            <!-- Modal Footer - Delete Button -->
            <div class="flex justify-end pt-2">
                <button id="confirmDelete" class="modal-close px-4 bg-red-500 p-2 rounded-lg text-white hover:bg-red-400">Delete</button>
            </div>
        </div>
    </div>
</div>


      <!-- Edit Item Modal -->
<div id="editItemModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden">
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Edit Inventory Item</p>
                <button id="closeEditModal" class="modal-close cursor-pointer z-50">
                    <i class="fas fa-times text-gray-500"></i>
                </button>
            </div>
            <!-- Modal Body - Fields: Name, Quantity, Amount -->
            <form method="POST" data-action="{{ route('update-inventory', ['id' => ':id']) }}" id="editItemForm">
                @csrf
                @method('PUT') <!-- Use the appropriate HTTP method for updating -->
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
                <!-- Modal Footer - Save Button -->
                <div class="flex justify-end pt-2">
                    <button type="submit" class="modal-close px-4 bg-blue-500 p-2 rounded-lg text-white hover-bg-blue-400">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Modal HTML -->
    <div id="inventoryModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden">
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Add Inventory</p>
                    <button id="closeModal" class="modal-close cursor-pointer z-50">
                        <i class="fas fa-times text-gray-500"></i>
                    </button>
                </div>
                <!-- Modal Body - Fields: Name, Quantity, Amount -->
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
                    <!-- Modal Footer - Save Button -->
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="modal-close px-4 bg-blue-500 p-2 rounded-lg text-white hover:bg-blue-400">Add Inventory</button>
                    </div>
                </form>
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

   // Open the edit item modal when clicking the edit icon
document.querySelectorAll(".edit-item").forEach(function(editButton) {
    editButton.addEventListener("click", function(event) {
        event.preventDefault();
        var itemId = event.currentTarget.getAttribute("data-id");
        var itemRow = document.querySelector(`tr[data-id="${itemId}"]`);
        var itemName = itemRow.querySelector("td:nth-child(1)").innerText;
        var itemQuantity = itemRow.querySelector("td:nth-child(2)").innerText;
        var itemAmount = itemRow.querySelector("td:nth-child(3)").innerText;

        // Populate the edit modal with the correct item data
        document.getElementById("editItemId").value = itemId;
        document.getElementById("editName").value = itemName;
        document.getElementById("editQuantity").value = itemQuantity;
        document.getElementById("editAmount").value = itemAmount;

        // Set the action attribute of the form dynamically
        var editItemForm = document.getElementById("editItemForm");
        var editRoute = editItemForm.getAttribute("data-action");
        editRoute = editRoute.replace(":id", itemId);
        editItemForm.setAttribute("action", editRoute);

        document.getElementById("editItemModal").classList.remove("hidden");
    });
});

// Handle item deletion when the user confirms
document.querySelectorAll(".delete-item").forEach(function (deleteButton) {
    deleteButton.addEventListener("click", function (event) {
        event.preventDefault();
        var itemId = event.currentTarget.getAttribute("data-id");
        var itemRow = document.querySelector(`tr[data-id="${itemId}"]`);

        // Show the delete confirmation modal
        document.getElementById("deleteItemModal").classList.remove("hidden");

        // Set the data-id for the delete button in the modal
        document.getElementById("confirmDelete").setAttribute("data-id", itemId);
    });
});

// Handle confirmation and deletion in the modal
document.getElementById("confirmDelete").addEventListener("click", function (event) {
    var itemId = event.currentTarget.getAttribute("data-id");
    var itemRow = document.querySelector(`tr[data-id="${itemId}"]`);

    // Send an AJAX request to delete the item from the database
    $.ajax({
        type: "DELETE",
        url: `/inventory/${itemId}`,
        data: {
            _token: "{{ csrf_token() }}", // Include the CSRF token
        },
        success: function () {
            // Item deleted successfully, remove it from the table
            itemRow.remove();
            // Close the delete modal
            document.getElementById("deleteItemModal").classList.add("hidden");
        },
        error: function () {
            alert("Failed to delete the item.");
            // Close the delete modal
            document.getElementById("deleteItemModal").classList.add("hidden");
        }
    });
});

// Close the delete modal when the user clicks the close button
document.getElementById("closeDeleteModal").addEventListener("click", function () {
    document.getElementById("deleteItemModal").classList.add("hidden");
});


</script>


    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
