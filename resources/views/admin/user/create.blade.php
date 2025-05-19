<x-admin>
    @section('title')
        {{ 'Create user' }}
    @endsection
    <section class="content">
        <!-- Default box -->
        <div class="d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create New user</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-dark">Back</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.user.store') }}" method="POST" class="needs-validation"
                        novalidate="">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">User Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            required="" value="{{ old('name') }}">
                                        @error('name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                        <div class="invalid-feedback">user name field is required.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            required="" value="{{ old('email') }}">
                                        @error('email')
                                            <span>{{ $message }}</span>
                                        @enderror
                                        <div class="invalid-feedback">email field is required.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="text" class="form-control" name="password" id="password"
                                            required="" value="{{ old('password') }}">
                                        @error('password')
                                            <span>{{ $message }}</span>
                                        @enderror
                                        <div class="invalid-feedback">user name field is required.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>

                                        {{-- {!! Html::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!} --}}
                                        {!! Form::select('roles[]', $roles, old('roles'), ['class' => 'form-control', 'multiple' => 'multiple']) !!}

                                        {!! Html::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}

                                        @error('roles')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="invalid-feedback">user name field is required.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer float-end float-right">
                            <button type="submit" id="submit"
                                class="btn btn-primary float-end float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card -->

    </section>
</x-admin>
