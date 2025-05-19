<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>product-pdf</title>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #0056f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        h1 {
            text-align: center;
            color: #e6d709;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #c6fd00;
        }

        th {
            background-color: #00e0fd;
        }

        tr:hover {
            background-color: #05e910;
        }

        .animate__animated .animate__fadeInRow {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>

    <!-- Link to Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-nIe/2IEMaTfE6JazlZEmKfZHEec5eA8PUe3cDsQVssFa+aPDqtCHv50/Wqa/E7s68gYfNb2QJOq4J7v+fu8KcQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link to Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        integrity="sha384-btZtPw+CmU2m5P/GVQlKs5l9IdFMS6z7gCkkxYIe9XQDjPU6aDD45PcWrsga/1QKd" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="animate__animated animate__fadeInDown">List of Product</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>



        <img src="data:image/png;base64,{{ $qrcode }}" alt="QR Code">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th colspan="2">ID</th>
                    <th colspan="2">Name</th>
                    <th colspan="2">Price</th>
                    <th colspan="2">QR Code</th>
                    <th colspan="2">Created At</th>
                    <th colspan="2">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $product)
                    <tr class="animate__animated animate__fadeInRow">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->uuid }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{!! DNS2D::getBarcodeHTML("$product->product_pdf", 'QRCODE') !!}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 JS and Popper.js (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-lqU8iIb8XY2U3ZO3pGFi7KzN5Fz9XifZXrwiqUqjvBEXq1vE2WKceMeBSPe3e02Z" crossorigin="anonymous">
    </script>
</body>

</html>
