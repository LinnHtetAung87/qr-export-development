<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use PDF;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




use Ramsey\Uuid\Uuid;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $data = Product::orderBy('id', 'DESC')->paginate(5);
        view()->share('data', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0.00',

            'currency' => 'required',


        ]);
        $uuid4 = Uuid::uuid4();
        $uuid = $uuid4->toString();
        $product_uuid = substr($uuid, 0, 8) . '-' . substr($uuid, 9, 4) . '-' . substr($uuid, 14, 4) . '-' . substr($uuid, 19, 4) . '-' . substr($uuid, 24);

        $product = new Product();

        $product->uuid = $product_uuid;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->currency = $request->currency;

        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }


        $product->name = $request->name;
        $product->price = $request->price;

        $number = mt_rand(1000000000,9999999999);

        if ($this->productpdf($number)) {
        $number = mt_rand(1000000000,999999999);
        }

        $product->product_pdf = $number;

        $product->uuid = $product_uuid;


        $product->save();



        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    public function productpdf($number){
        return product::whereproduct_pdf($number)->exists();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data = Product::where('uuid', $uuid)->first();
        return view('admin.products.edit', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0.00',
        ]);
        $product = Product::where('uuid',$request->uuid)->first();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the external image.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        if ($product) {
            $product->delete();
            return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
        }else{
            return redirect()->route('admin.product.index')->with('error', 'Product not found!');
        }
    }


    public function generatePDF($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        $date = Carbon::parse($product->created_at)->format('d-M-Y');

        $imagePath = public_path('admin/dist/img/phplogo.png');

        // Generate a QR code
        $app_url = config('app.url');

        $generate_url = $app_url. '/qr/'.$product->id;
        $qrCode = QrCode::size(100)->generate($generate_url);

        $pdf = PDF::loadView('admin.products.pdf', compact('product','date','imagePath','qrCode'));

        return $pdf->download($product->uuid.'.pdf');
    }

    public function product_pdf($uuid)
    {
        $product = Product::where('uuid', $uuid)->firstOrFail();

        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($product->uuid));

        $data = [
        'product' => $product,
        'qrcode' => $qrcode,
        ];

        $pdf = Pdf::loadView('admin.pdf.product-pdf', $data);
        $fileName = sprintf('product[%s].pdf', $uuid);

        return $pdf->download($fileName);
    }


}
