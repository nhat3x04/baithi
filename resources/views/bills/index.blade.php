@extends('layoutadmin.master')

@section('content')
<div class="container">
    <h1>List of Bills</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Date Order</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Note</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->id_customer }}</td>
                    <td>{{ $bill->date_order }}</td>
                    <td>{{ $bill->total }}</td>
                    <td>{{ $bill->payment }}</td>
                    <td>{{ $bill->note }}</td>
                    <td>{{ $bill->status }}</td>
                    <td>
                        <a href="{{ route('bill.edit', $bill->id) }}" class="btn btn-primary">Edit Status</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection