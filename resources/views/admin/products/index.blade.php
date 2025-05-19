<x-admin>
    @section('title')
        {{ 'Product' }}
    @endsection


  

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Product Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>

                        <th>Currency</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>PDF Export</th>

                        <th>Barcode</th>
                        <th>Created At</th>
                        <th>Updated At</th>

                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $product)
                        <tr>

                            <td>{{ $index+1 }}</td>
                            <td>{{ $product->uuid }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->currency }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td><a href="{{ route('admin.generate_pdf', $product->uuid) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-file-export"></i> </a></td>
                            <td><a href="{{ route('admin.product.edit', $product->uuid) }}"
                                    class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a></td>
                            <td>
                                <form action="{{ route('admin.product.destroy', $product->uuid) }}" method="POST" onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center bg-danger">Product not created</td>
                            </tr>

                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->uuid }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{!! DNS2D::getBarcodeHTML("$product->product_pdf", 'QRCODE') !!}
                                p - {{ $product->product_pdf }}
                            </td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td><a href="{{ route('admin.product.edit', $product->uuid) }}"
                                    class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a></td>
                            <td>
                                <div>
                                    <a href="{{ route('admin.product_pdf', ['uuid' => $product->uuid]) }}">Download
                                        PDF</a>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('admin.product.destroy', $product->uuid) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center bg-danger">Product not created</td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @section('js')

        <script>
        </script>

        <script></script>

    @endsection
</x-admin>
