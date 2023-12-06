
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
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
    @include('staff/sidebar')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
<div class="container">
    <div class="content">
        <div class="container"><br>
        <button type="button" id="showModal" class="btn btn-primary">Request Materials</button><br><br><hr><br>

        <div class="modal" tabindex="-1" role="dialog" id="materialModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Request Materials</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                    </div>
                    <div class="modal-body">
                        <form id="materialForm" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Material Name</label>
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
                        <button type="button" class="btn btn-primary" id="saveMaterial">Submit Request</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="materials-list">
            <h1>Requested Materials List</h1><br>
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Requested Date/Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $material)
                    <tr data-id="{{ $material->id }}" class="@if($material->status === 'accepted') table-success @elseif($material->status === 'declined') table-danger @endif">
                    <td>{{ $material->name }}</td>
                        <td>{{ $material->quantity }}</td>
                        <td>{{ $material->amount }}</td>
                        <td class="@if($material->status === 'accepted') status-accepted @endif">
                            {{ $material->status }}
                            @if($material->status === 'accepted')
                                <i class="fas fa-check-circle text-success"></i>
                            @elseif($material->status === 'declined')
                                <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </td>
                        <td>{{$material->created_at}}</td>
                        <td>
                            <button class="bg-blue-500 text-white py-1 px-2 rounded-l-full text-sm focus:outline-none focus:shadow-outline-blue active:bg-blue-800 flex-shrink-0g edit-material" data-id="{{ $material->id }}">Edit</button>
                            <button class="bg-red-500 text-white py-1 px-2 rounded-r-full text-sm focus:outline-none focus:shadow-outline-blue active:bg-blue-800 flex-shrink-0 delete-material" data-id="{{ $material->id }}">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>


        <!-- Delete Confirmation Modal -->
        <div class="modal" tabindex="-1" role="dialog" id="deleteMaterialModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this material?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveEditedMaterial">Save</button>
                    </div>
                </div>
            </div>
        </div>

        </div>
       

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
                     }
                });
            });

            $('.edit-material').click(function () {
                const materialId = $(this).data('id');
                const materialRow = $(`tr[data-id="${materialId}"]`);
                const name = materialRow.find('td:eq(0)').text();
                const quantity = materialRow.find('td:eq(1)').text();
                const amount = materialRow.find('td:eq(2)').text();

                $('#editMaterialId').val(materialId);
                $('#editName').val(name);
                $('#editQuantity').val(quantity);
                $('#editAmount').val(amount); 
                $('#editMaterialModal').modal('show');
            });

             $('#saveEditedMaterial').click(function () {
                const materialId = $('#editMaterialId').val();

                $.ajax({
                    url: `/materials/${materialId}`,
                    method: 'PUT',
                    data: $('#editMaterialForm').serialize(),
                    success: function (response) {
                        $('#editMaterialModal').modal('hide');
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });

            $('.delete-material').click(function () {
                const materialId = $(this).data('id');
                $('#deleteMaterialModal').modal('show');
                $('#confirmDelete').data('id', materialId);
            });

            $('#confirmDelete').click(function () {
                const materialId = $(this).data('id');
                $.ajax({
                    url: `/materials/${materialId}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#deleteMaterialModal').modal('hide');
                        $(`tr[data-id="${materialId}"]`).remove();
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });
        });
        new DataTable('#datatable');
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

</body>
</html>
