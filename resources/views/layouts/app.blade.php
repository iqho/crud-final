<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>@yield('title') </title>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
        </script>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- DataTables  CDN -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    </head>

    <body class="container">

        <div class="row">
            <nav class="col-md-12">

                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Produt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.create') }}">Add Product</a>
                    </li>
                </ul>
                
            </nav>
            <div class="nav-item">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h2>Crud Final</h2>
                </a>
            </div>
        </div>

        <div class="container">

            @yield('content')
            
        </div>

        <script type="text/javascript">

            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>

        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

        @stack('scripts')

    </body>
</html>
