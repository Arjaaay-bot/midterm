
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link href="{{asset('css/modal.css')}}" rel="stylesheet">
    <script src="{{asset('js/modal.js')}}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css'); 
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<style>
    a{
            text-decoration: none;
        }
    div.dataTables_wrapper input {
        margin: 1em;
    }
    .btn-primary{

    background-color: #007bff;
    color: #fff !important; 
}
.btn-danger {
    background-color: red;
    
}
.btn-primary:hover
 {
    background-color: #007bff;
    color: #fff !important; 
}
.btn-close {
    color: #000; 
}

.btn-close:hover {
    color: #000; 
}


</style>
<body>
 
<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <div class="">
        <div class="mx-auto px-3 sm:px-5 lg:px-1 bg-white bg-opacity-90 p-2 rounded-lg shadow-md h-full">

            <div class="flex justify-center mt-4">          
                </div>
            <div class="container">
        <div class="d-flex justify-content-between align-items-center">
       
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                <i class="fas fa-plus-circle text-xl mr-2"></i> Add Project
                </button>
        </div>
            <div id="universityTable" class="h-full">
                <h2 class="text-2xl font-bold mb-4 text-center">Projects List</h2>
                <div class="overflow-y-auto max-h-full">
                    <table class="min-w-full divide-y divide-gray-200" id="myDataTable">
                        <thead>
                            <tr>
                                <th style="color:dark;" class="px-6 py-3 text-left text-xs leading-4 font-medium uppercase tracking-wider">
                                Project Name
                                </th>
                                <th style="color:dark;"
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium  uppercase tracking-wider">
                                    Project Description
                                </th>
                                <th style="color:dark;"
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium  uppercase tracking-wider">
                                    Client
                                </th>
                                <th style="color:dark;"
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium  uppercase tracking-wider">
                                    Project Start Date
                                </th>
                                <th style="color:dark;"
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium  uppercase tracking-wider">
                                    Project End Date
                                </th>
                                <th style="color:dark;"
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium  uppercase tracking-wider">
                                    Status
                                </th>
                                <th style="color:dark;"
                                    class="px-6 py-3 text-left text-xs leading-4 font-medium  uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->project_name }}</td>
                            <td>{{ $project->project_description }}</td>
                            <td>{{ $project->client }}</td>
                            <td>{{ $project->project_start_date }}</td>
                            <td>{{ $project->project_end_date }}</td>
                            <td>{{ $project->status }}</td>
                            <td>
                            <button type="button" class="editBtn bg-blue-500 text-white py-1 px-2 rounded-l-full text-sm focus:outline-none focus:shadow-outline-blue active:bg-blue-800 flex-shrink-0" data-id="{{ $project->id }}">Edit</button>
                            <button type="button" class="deleteBtn bg-red-500 text-white py-1 px-2 rounded-r-full text-sm focus:outline-none focus:shadow-outline-red active:bg-red-800 flex-shrink-0" data-id="{{ $project->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
                             
                </div>
            </div>

        </div>
    </div>

        @foreach($projects as $project)
            <div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel{{ $project->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProjectModalLabel{{ $project->id }}">Edit Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                             Edit Project Form 
                            <form method="post" action="{{ route('admin.projects.update', $project->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="edit_project_name">Project Name</label>
                                    <input type="text" class="form-control" id="edit_project_name" name="project_name" value="{{ $project->project_name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_project_description">Project Description</label>
                                    <textarea class="form-control" id="edit_project_description" name="project_description" rows="3" required>{{ $project->project_description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="edit_client">Client</label>
                                    <input type="text" class="form-control" id="edit_client" name="client" value="{{ $project->client }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_project_start_date">Project Start Date</label>
                                    <input type="date" class="form-control" id="edit_project_start_date" name="project_start_date" value="{{ $project->project_start_date }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_project_end_date">Project End Date</label>
                                    <input type="date" class="form-control" id="edit_project_end_date" name="project_end_date" value="{{ $project->project_end_date }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Project</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        @foreach($projects as $project)
            <div class="modal fade" id="deleteProjectModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteProjectModalLabel{{ $project->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteProjectModalLabel{{ $project->id }}">Delete Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete the project: <strong>{{ $project->project_name }}</strong>?</p>
                            <form method="post" action="{{ route('admin.projects.destroy', $project->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Project</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


      
        <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProjectModalLabel">Add Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         Add Project Form 
                        <form method="post" action="{{ route('admin.projects.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="add_project_name">Project Name</label>
                                <input type="text" class="form-control" id="add_project_name" name="project_name" required>
                            </div>

                            <div class="form-group">
                                <label for="add_project_description">Project Description</label>
                                <textarea class="form-control" id="add_project_description" name="project_description" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="add_client">Client</label>
                                <input type="text" class="form-control" id="add_client" name="client" required>
                            </div>

                            <div class="form-group">
                                <label for="add_project_start_date">Project Start Date</label>
                                <input type="date" class="form-control" id="add_project_start_date" name="project_start_date" required>
                            </div>

                            <div class="form-group">
                                <label for="add_project_end_date">Project End Date</label>
                                <input type="date" class="form-control" id="add_project_end_date" name="project_end_date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    
    $(document).ready(function () {
        $('#myDataTable').DataTable();
    $('.deleteBtn').click(function () {
        const projectId = $(this).data('id');
        $('#deleteProjectModal' + projectId).modal('show');
    });

    $('.editBtn ').click(function () {
        const projectId = $(this).data('id');
        $('#editProjectModal' + projectId).modal('show');
    });
    });
   
</script>
</body>
</html>

