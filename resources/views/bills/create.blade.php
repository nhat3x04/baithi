@extends('layoutadmin.master')

@section('content')
<div class="container">
    <h1>Add New Bill</h1>
    <form action="{{ route('bill.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_customer">Customer ID</label>
            <input type="number" name="id_customer" class="form-control" id="id_customer" required>
        </div>
        <div class="form-group">
            <label for="date_order">Date Order</label>
            <input type="date" name="date_order" class="form-control" id="date_order" required>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" step="0.01" name="total" class="form-control" id="total" required>
        </div>
        <div class="form-group">
            <label for="payment">Payment</label>
            <input type="text" name="payment" class="form-control" id="payment" required>
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <textarea name="note" class="form-control" id="note"></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="New">New</option>
                <option value="In Progress">In Progress</option>
                <option value="Delivered">Delivered</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Bill</button>
    </form>
</div>
@endsection