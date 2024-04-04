
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body>
    <h1>Inventory List</h1>
    <table id="inventoryTable">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Stock</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
            <tr>
                <td>{{ $inventory->product->prod_name }}</td>
                <td>{{ $inventory->stock }}</td>
                <td>
                    @foreach(explode(',', $inventory->product->img) as $img)
                        <img src="{{ asset($img) }}" alt="Product Image" style="max-width: 100px; max-height: 100px; margin-right: 5px;">
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('inventory.edit', $inventory->id) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('inventory.create') }}" class="btn btn-primary mt-4"><i class="fas fa-plus"></i> Add Inventory</a>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#inventoryTable').DataTable();
        });
    </script>
</body>
</html>
