<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::all();
        return view('bills.index', compact('bills'));
    }
    public function show($id)
    {
        $bill = Bill::find($id);
        return view('bills.show', compact('bill'));
    }

    public function create()
    {
        return view('bills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'required|exists:customers,id',
            'date_order' => 'required|date',
            'total' => 'required|numeric',
            'payment' => 'required|string',
            'note' => 'nullable|string',
            'status' => 'required|string|in:New,In Progress,Delivered,Cancelled',
        ]);

        Bill::create([
            'id_customer' => $request->id_customer,
            'date_order' => $request->date_order,
            'total' => $request->total,
            'payment' => $request->payment,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        return redirect()->route('bill.list')->with('success', 'Bill created successfully.');
    }

    public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        return view('bills.edit', compact('bill'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:New,In Progress,Delivered,Cancelled',
        ]);

        $bill = Bill::findOrFail($id);
        $bill->update(['status' => $request->status]);

        return redirect()->route('bill.list')->with('success', 'Bill status updated successfully.');
    }
}