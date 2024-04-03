

@extends('layouts.sidebar')
@extends('product.css.inventorycss')



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Data Table</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>   
</head>

<body>
   


    
    <!-- jQuery -->


    <div class="container mx-auto mt-8">
        <!-- Artworks Table -->
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-xs-5">
                        <h2>Product <b>Management</b></h2>
                    </div>
                    <div class="col-xs-7">
                        <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="material-icons">&#xE147;</i> <span>Add New Prodcut</span></a>

                    </div>
                </div>
            </div>
            <table id="artworkTable" class="table table-striped table-hover">
                <thead class="text-black bg-gray-800">
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Supplier</th>
                        <th>Image</th>
                        <th>Actions</th> <!-- Added column for CRUD actions -->
                        <th>Edit</th>
                        <th>Delete/Restore</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td><a>{{ $product->prod_name }}</a></td>  
                        <td>{{ $product->prod_desc }}</td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                        @if ($product->suppliers->isNotEmpty())
                        {{ $product->suppliers->first()->name }}
                    @else
                        N/A
                    @endif
                        </td>
                        <td>
                            @if ($product->img)
                            <?php $imgPaths = explode(',', $product->img); ?>
                            <img src="{{ asset($imgPaths[0]) }}" alt="{{ $product->prod_name }}" style="max-width: 100px; max-height: 100px;">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showArtworkModal{{ $product->id }}"><i class="fas fa-eye"></i> Show</button>
                        </td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-lg w10 h10 me-2 settings" title="Edit" data-toggle="tooltip">
                                <i class="material-icons">&#xE8B8;</i>
                            </a>

                        </td>
                        <td class="text-center">


                            @if ($product->trashed())

                            {{-- Restore button --}}
                            <form method="GET" action="{{ route('product.restore', $product->id) }}">
                                @csrf

                                <button type="submit" class="bg-green-500 btn btn-sm"><i class="fas fa-trash-restore" style="color:  #32CD32;"></i> Restore</button>
                            </form>


                            @else

                            {{-- Delete button --}}
                            <form method="POST" action="{{ route('product.destroy', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm " title="Delete" data-toggle="tooltip">
                                    <i class="material-icons" style="color: red;">&#xE5C9;</i>
                                </button>
                            </form>

                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Bootstrap JS -->

    <div class="frame">

    </div>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#artworkTable').DataTable();
    });
</script>

</html>