
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
    @include('staff/sidebar')

    <div class="content">
    <div class="container">
    <button type="button" id="showModal" class="btn btn-primary">Request Materials</button><br><hr>

     <!-- Modal -->
     <div class="modal" tabindex="-1" role="dialog" id="materialModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="materialForm" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveMaterial">Save</button>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Display Materials List -->
<div class="materials-list">
    <h2>Requested Materials List</h2><br><br>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th> <!-- New column for action buttons -->
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
            <tr data-id="{{ $material->id }}">
                <td>{{ $material->name }}</td>
                <td>{{ $material->quantity }}</td>
                <td>{{ $material->amount }}</td>
                <td>{{ $material->status }}</td>
                <td>
                    <button class="btn btn-warning edit-material" data-id="{{ $material->id }}">Edit</button>
                    <button class="btn btn-danger delete-material" data-id="{{ $material->id }}">Delete</button>
                </td>

                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


    <!-- Delete Confirmation Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="deleteMaterialModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this material?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

         <!-- Edit Material Modal -->
<div class="modal" tabindex="-1" role="dialog" id="editMaterialModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMaterialForm">
                    @csrf
                    @method('PUT') <!-- Use the appropriate method for your server-side routing -->
                    <input type="hidden" id="editMaterialId" name="id">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editQuantity">Quantity</label>
                        <input type="number" class="form-control" id="editQuantity" name="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="editAmount">Amount</label>
                        <input type="number" class="form-control" id="editAmount" name="amount" step="0.01" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveEditedMaterial">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#showModal').click(function () {
            $('#materialModal').modal('show');
        });

        $('#saveMaterial').click(function () {
            $.ajax({
                url: '/save-material',
                method: 'POST',
                data: $('#materialForm').serialize(),
                success: function (response) {
                    $('#materialModal').modal('hide');
                    // Optionally, you can update the UI with the newly added material.
                }
            });
        });

        // Show the edit material modal when clicking the edit button
        $('.edit-material').click(function () {
            const materialId = $(this).data('id');
            const materialRow = $(`tr[data-id="${materialId}"]`);
            const name = materialRow.find('td:eq(0)').text();
            const quantity = materialRow.find('td:eq(1)').text();
            const amount = materialRow.find('td:eq(2)').text();

            // Populate the edit form fields with the material data
            $('#editMaterialId').val(materialId);
            $('#editName').val(name);
            $('#editQuantity').val(quantity);
            $('#editAmount').val(amount);

            // Show the edit material modal
            $('#editMaterialModal').modal('show');
        });

        // Handle material update when the user clicks the "Save" button in the edit modal
        $('#saveEditedMaterial').click(function () {
            const materialId = $('#editMaterialId').val();

            $.ajax({
                url: `/materials/${materialId}`,
                method: 'PUT',
                data: $('#editMaterialForm').serialize(),
                success: function (response) {
                    $('#editMaterialModal').modal('hide');
                    // Optionally, you can update the UI with the edited material data.
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

        // Show the delete confirmation modal when clicking the delete button
        $('.delete-material').click(function () {
            const materialId = $(this).data('id');
            $('#deleteMaterialModal').modal('show');

            // Pass the material ID to the modal's confirmation button
            $('#confirmDelete').data('id', materialId);
        });

        // Handle material deletion when the user confirms
        $('#confirmDelete').click(function () {
            const materialId = $(this).data('id');

            // Send an AJAX request to delete the material
            $.ajax({
                url: `/materials/${materialId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $('#deleteMaterialModal').modal('hide');
                    // Remove the deleted material row from the table
                    $(`tr[data-id="${materialId}"]`).remove();
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
</script>




    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- jQuery and Bootstrap JS -->
   

</body>
</html>
