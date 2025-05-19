<x-admin>
    @section('title')
        {{ 'Roles' }}
    @endsection
    @php
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');
        $alertClass = $successMessage ? 'success' : ($errorMessage ? 'danger' : null);
    @endphp

    @if ($alertClass)
        <div class="alert alert-{{ $alertClass }} alert-dismissible fade show" role="alert">
            <strong>{{ $successMessage ?? $errorMessage }}</strong>
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            setTimeout(function () {
                try {
                    $('.alert').alert('close');
                } catch (e) {
                    console.error('An error occurred while closing the alert:', e);
                }
            }, 5000);
        </script>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles</h3>
            <div class="card-tools">
                @can('role-create')
                    <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-primary">Add</a>
                @endcan
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Permission</th>
                        <th>Created</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <style>
                        .hidden-id {
                            display: none;
                        }
                    </style>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($data as $role)
                        <tr>
                            <td>{{ $counter }}</td>
                            <td class="hidden-id">{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    {{ $permission->name . '/' }}
                                @endforeach
                            </td>
                            <td>{{ $role->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                @can('role-edit')
                                <a href="{{ route('admin.role.edit', encrypt($role->id)) }}"
                                    class="btn btn-sm btn-secondary">
                                    <i class="far fa-edit"></i>
                                </a>
                                @endcan
                            </td>
                            <td>
                                @can('role-delete')
                                <form action="{{ route('admin.role.destroy', encrypt($role->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @php
                            $counter++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-admin>
