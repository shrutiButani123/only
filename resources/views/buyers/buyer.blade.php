@extends('layout.app')

@section('content')
<div class="container">
    <h2>Buyer List</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBuyerModal">Add Buyer</button>
    <table class="table">
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
                    <a href="{{ route('buyers.edit', $buyer->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('buyers.destroy', $buyer->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete Buyer?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Buyer Modal -->
<div class="modal fade" id="addBuyerModal" tabindex="-1" aria-labelledby="addBuyerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBuyerModalLabel">Add Buyer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('buyers.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Address:</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Mobile No:</label>
                        <input type="text" name="mobile_no" class="form-control" required>
                    </div>
                    <div class="mb-2">
                            <label>Buyer Type</label>
                            <select id="buyer_type" name="buyer_type" class="form-select" required>
                                <option value="retail">Retail</option>
                                <option value="wholesale">Wholesale</option>
                            </select>
                    </div>
                    <div class="mb-2">
                        <label>Cut Quality:</label>
                        <input type="text" name="cut_quality" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Color:</label>
                        <input type="text" name="color" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Clarity:</label>
                        <input type="text" name="clarity" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Carat Weight:</label>
                        <input type="number" name="carat_weight" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Amount:</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Buyer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
