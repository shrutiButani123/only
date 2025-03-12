@extends('layout.app')

@section('content')
    <h2>Buyers List</h2>
    <a href="{{ route('buyers.create') }}" class="btn btn-primary mb-3">Add Buyer</a>
    <br>
    <a href="{{ route('buyers.export', ['type' => 'all']) }}" class="btn btn-success mb-2">Export All Buyers</a>
    <a href="{{ route('buyers.export', ['type' => 'page']) }}" class="btn btn-info mb-2">Export Current Page</a>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table  id="buyerTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Mobile No</th>
                <th>Buyer Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buyers as $buyer)
            <tr>
                <td>{{ $buyer->name }}</td>
                <td>{{ $buyer->email }}</td>
                <td>{{ $buyer->address }}</td>
                <td>{{ $buyer->mobile_no }}</td>
                <td>{{ $buyer->buyer_type }}</td>
                <td>
                    <a href="{{ route('buyers.edit', $buyer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('buyers.destroy', $buyer->id) }}" method="POST" style="display:inline;" class="delete-form" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')
<script>
        // $(document).ready(function () {
        //     $('.delete-form').on('submit', function (e) {
        //         e.preventDefault(); // Prevent form submission
        //         var form = this;

        //         if (confirm('Are you sure you want to delete this buyer?')) {
        //             form.submit(); // Submit the form if confirmed
        //         }
        //     });
        // });
        $(document).ready(function() {
            $('#buyerTable').DataTable(); // Initialize DataTables
        });

        function confirmDelete() {
            return confirm('Are you sure you want to delete this buyer?');
        }
    </script>
@endsection
