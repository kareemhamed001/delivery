<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete This user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="emptyFields">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confirm delete
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="emptyFields">Cancel</button>
                    <button type="button" class="btn btn-primary" wire:click="confirmDelete">Yes delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h4 class="h4 font-weight-bold text-gray-800 col">{{$pageTitle}}</h4>


        <div class="col ">
            <a class="btn btn btn-primary float-end shadow" href="{{url('admin/addUser')}}">Add</a>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4 ">
            <div class="card p-0 border-left-primary shadow h-100 ">
                <div class="card-body p-2 row align-items-center">
                    <div class="row no-gutters align-items-center">
                        <div class="col h-100 mr-2 ">
                            <div class="h6 font-weight-bold text-primary text-uppercase mb-1">
                                {{$pageTitle}} Count
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-success">
                                {{$count}}
                            </div>

                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-user fa-2x  text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="my-2 col">
            <label for="filter" class="font-weight-bold">Show</label>
            <select class="form-select m-0" id="filter" wire:model="filterValue">
                <option value="">All</option>
                <option value="0">User</option>
                <option value="1">Driver</option>
                <option value="2">Admin</option>
            </select>
        </div>

        <div class="my-2 col">

            <label for="search" class="font-weight-bold">Search</label>
            <input type="text" wire:model="term" id="search" class="form-control" placeholder="Search User">

        </div>
    </div>

    <div class="row table-responsive  ">
        <table class="table table-sm table-bordered shadow ">
            <thead>
                <tr>
                    <td>#</td>
                    <td>name</td>
                    <td>email</td>
                    <td>phone</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>

            @forelse($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>
                        <button class="btn btn-sm btn-danger "  wire:click="setId({{$user->id}})">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No data</td>

                </tr>
            @endforelse

            </tbody>

        </table>
        {{$users->links()}}
    </div>


</div>
@push('scripts')
    <script>

        window.addEventListener('close-delete-modal',function (){
            var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.hide();
            $('#deleteModal').modal('hide');
        });
        window.addEventListener('open-delete-modal',function (){
            var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        });

    </script>
@endpush
