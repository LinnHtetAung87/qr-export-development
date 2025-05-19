<x-admin>
    @section('title', 'Edit Role')

    <section class="content">
        <!-- Default box -->
        <div class="d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Role</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-dark">Back</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.role.update', [$data->id]) }}" method="POST" class="needs-validation" novalidate>
                        @method('PATCH') @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Role Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="invalid-feedback">Role name field is required.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="permission">Permission:</label>
                                        <div class="row">
                                            @foreach ($permissions as $id => $name)
                                                <div class="col-md-3">
                                                    <label>
                                                        {{ Form::checkbox('permissions[]', $id, in_array($id, $rolePermissions) ? true : false) }}
                                                        {{ $name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('permissions')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="invalid-feedback">Permission field is required.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary float-end">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
</x-admin>
