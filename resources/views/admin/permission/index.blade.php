<x-admin>
    @section('title')
        {{ 'Permission' }}
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
            setTimeout(function() {
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
            <h3 class="card-title">Permission</h3>
            <div class="card-tools">
                @can('permission-create')
                    <a href="{{ route('admin.permission.create') }}" class="btn btn-sm btn-primary">Add</a>
                @endcan
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @forelse ($data as $permission)
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td>
                                @can('permission-edit')
                                    <a href="{{ route('admin.permission.edit', encrypt($permission->id)) }}"
                                        class="btn btn-sm btn-secondary">
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan
                            </td>
                            <td>
                                @can('permission-delete')
                                    <form action="{{ route('admin.permission.destroy', encrypt($permission->id)) }}"
                                        method="POST" onsubmit="return confirm('Are sure want to delete?')">
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
                    @empty

                        <tr>
                            <td colspan="4" class="text-center bg-danger">Permission not created</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-admin>
