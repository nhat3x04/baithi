@extends('layoutadmin.master')

@section('content')
<div class="container">
    <h1>Edit Bill Status</h1>
    <form action="{{ route('bill.update', $bill->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="New" {{ $bill->status == 'New' ? 'selected' : '' }}>New</option>
                <option value="In Progress" {{ $bill->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Delivered" {{ $bill->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="Cancelled" {{ $bill->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
@endsection