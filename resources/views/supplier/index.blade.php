<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mx-auto mt-8">
    <!-- Artworks Table -->
    <table id="artworkTable" class="table table-striped table-bordered">
        <thead class="bg-gray-800 text-black">
            <tr>
                <th>Supplier Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Image</th>
                <th>Actions</th> <!-- Added column for CRUD actions -->
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->name }}</td>      
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->contactno }}</td>
                <td>
                    @if ($supplier->img)
                        <?php $imgPaths = explode(',', $supplier->img); ?>
                        <img src="{{ asset($imgPaths[0]) }}" alt="{{ $supplier->name }}" style="max-width: 100px; max-height: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#showArtworkModal{{ $supplier->id }}"><i class="fas fa-eye"></i> Show</button>
                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-primary me-2"><i class="fas fa-edit"></i> Edit</a>
                    @if ($supplier->trashed())

                        {{-- Restore button --}}
                        <form method="GET" action="{{ route('supplier.restore', $supplier->id) }}">
                            @csrf
                            
                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-trash-restore"></i> Restore</button>
                        </form>

                        
                    @else
                        {{-- Delete button --}}
                        <form method="POST" action="{{ route('supplier.destroy', $supplier->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add Artwork Button -->
    <a href="{{ route('supplier.create') }}" class="btn btn-primary mt-4"><i class="fas fa-plus"></i> Add Supplier</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#artworkTable').DataTable();
    });
</script>
