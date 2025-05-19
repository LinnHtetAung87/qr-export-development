<x-admin>
    @section('title')
        {{ 'User' }}
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
            <h3 class="card-title">User Table</h3>
            <div class="card-tools">
                @can('user-create')
                    <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary">Add</a>
                @endcan
            </div>
        </div>

        <div class="p-0 card-body">

        <div class="card-body p-0">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>

                        <th>Photo</th>


                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 1; @endphp
                    @foreach ($data as $user)
                        <tr>
                            <td>{{ $counter++ }}</td>

                            <td>
                                <img src="{{ asset($user->profile_photo_path) }}" class="w-12 h-12 rounded-full">
                            </td>


                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->getRoleNames() as $role)
                                    <label>{{ $role }}</label>
                                @endforeach
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                @can('user-edit')
                                    <a href="{{ route('admin.user.edit', encrypt($user->id)) }}"
                                        class="btn btn-sm btn-secondary">
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan
                            </td>
                            <td>
                                @can('user-delete')
                                    <form action="{{ route('admin.user.destroy', encrypt($user->id)) }}" method="POST"
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
