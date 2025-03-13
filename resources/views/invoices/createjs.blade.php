@extends('layout.app')

@section('content')

<div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="mb-4">Create Invoice</h2>

            <form id="invoice-form" action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Customer Name:</label>
                    <input type="text" class="form-control" name="customer_name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Customer Email:</label>
                    <input type="email" class="form-control" name="customer_email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Invoice Date:</label>
                    <input type="date" class="form-control" name="invoice_date" required>
                </div>

                <h4 class="mt-4">Invoice Items</h4>
                <table class="table table-bordered" id="items-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="items[0][item_name]" required></td>
                            <td><input type="number" class="form-control quantity" name="items[0][quantity]" min="1" required></td>
                            <td><input type="number" class="form-control unit-price" name="items[0][unit_price]" min="0.01" step="0.01" required></td>
                            <td class="subtotal">0.00</td>
                            <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" id="add-item" class="btn btn-primary">Add Item</button>

                <div class="mt-4">
                    <label class="form-label">Gross Total:</label>
                    <input type="text" id="gross-total" class="form-control" readonly>
                </div>

                <div class="mt-3">
                    <label class="form-label">Discount:</label>
                    <input type="number" id="discount" class="form-control" name="discount" min="0" step="0.01">
                </div>

                <div class="mt-3">
                    <label class="form-label">Total Amount:</label>
                    <input type="text" id="total-amount" class="form-control" readonly>
                </div>

                <button type="submit" class="btn btn-success mt-4">Generate Invoice</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   

@endsection('content')

@section('scripts')
<script>
        $(document).ready(function () {
            let itemIndex = 1;

            function calculateTotals() {
                let grossTotal = 0;
                
                $('#items-table tbody tr').each(function () {
                    let quantity = parseFloat($(this).find('.quantity').val()) || 0;
                    let unitPrice = parseFloat($(this).find('.unit-price').val()) || 0;
                    let subtotal = quantity * unitPrice;
                    $(this).find('.subtotal').text(subtotal.toFixed(2));
                    grossTotal += subtotal;
                });

                $('#gross-total').val(grossTotal.toFixed(2));

                let discount = parseFloat($('#discount').val()) || 0;
                let totalAmount = grossTotal - discount;
                $('#total-amount').val(totalAmount.toFixed(2));
            }

            $('#add-item').click(function () {
                let newRow = `
                    <tr>
                        <td><input type="text" class="form-control" name="items[${itemIndex}][item_name]" required></td>
                        <td><input type="number" class="form-control quantity" name="items[${itemIndex}][quantity]" min="1" required></td>
                        <td><input type="number" class="form-control unit-price" name="items[${itemIndex}][unit_price]" min="0.01" step="0.01" required></td>
                        <td class="subtotal">0.00</td>
                        <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
                    </tr>
                `;
                $('#items-table tbody').append(newRow);
                itemIndex++;
            });

            $(document).on('input', '.quantity, .unit-price, #discount', function () {
                calculateTotals();
            });

            $(document).on('click', '.remove-item', function () {
                $(this).closest('tr').remove();
                calculateTotals();
            });

            // $('#invoice-form').submit(function (e) {
            //     e.preventDefault();

            //     $.ajax({
            //         url: '{{ route("invoices.store") }}',
            //         method: 'POST',
            //         data: $(this).serialize(),
            //         success: function (response) {
            //             alert(response.message);
            //             window.location.reload();
            //         },
            //         error: function (xhr) {
            //             alert('Error: ' + xhr.responseText);
            //         }
            //     });
            // });
        });
    </script>
@endsection
