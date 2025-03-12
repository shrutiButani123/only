@extends('layout.app')

@section('content')
<h2>Add Buyer</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('buyers.store') }}" method="POST">
        @csrf

        <div class="mb-2">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label>Address:</label>
            <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label>Mobile No:</label>
            <input type="text" name="mobile_no" class="form-control" value="{{ old('mobile_no') }}" required>
            @error('mobile_no') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label>Buyer Type</label>
            <select id="buyer_type" name="buyer_type" class="form-select" required>
                <option value="retail" {{ old('buyer_type') == 'retail' ? 'selected' : '' }}>Retail</option>
                <option value="wholesale" {{ old('buyer_type') == 'wholesale' ? 'selected' : '' }}>Wholesale</option>
            </select>
            @error('buyer_type') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label>Cut Quality:</label>
            <input type="text" name="cut_quality" class="form-control" value="{{ old('cut_quality') }}" required>
            @error('cut_quality') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label>Color:</label>
            <input type="text" name="color" class="form-control" value="{{ old('color') }}" required>
            @error('color') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label>Clarity:</label>
            <input type="text" name="clarity" class="form-control" value="{{ old('clarity') }}" required>
            @error('clarity') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label>Carat Weight:</label>
            <input type="number" name="carat_weight" class="form-control" value="{{ old('carat_weight') }}" required>
            @error('carat_weight') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-2">
            <label>Amount:</label>
            <input type="number" name="amount" class="form-control" value="{{ old('amount') }}" required>
            @error('amount') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Buyer</button>
    </form>
@endsection
