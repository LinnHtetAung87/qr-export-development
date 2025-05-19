<x-admin>
    @section('title')
        {{ 'Create Product' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Product</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.product.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-4">

                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="form-control" required>
                                        @error('name')

                                            <span class="text-danger">{{ $message }}</span>

                                            <span>{{ $message }}</span>

                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-4">

                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="text" name="price" id="price" value="{{ old('price') }}"
                                            class="form-control" required>
                                        @error('price')

                                            <span class="text-danger">{{ $message }}</span>

                                            <span>{{ $message }}</span>

                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="currency" class="form-label">Currency</label>
                                        <select name="currency" id="currency" class="form-control">
                                            <option selected disabled>select the currency</option>
                                            {{-- @foreach ($currency as $cat)
                                                <option {{ old($cat->id) == $cat->id ? 'selected' : '' }}
                                                    value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach --}}
                                            @foreach (config('constant.currency') as $key => $value)
                                                <option value="{{ $key }}" @selected (old('currency') == $key)>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('currency')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>

        </script>
    @endsection
</x-admin>
