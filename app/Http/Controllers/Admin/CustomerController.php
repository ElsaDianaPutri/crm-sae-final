<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(Request $request)
{
    $search = trim((string) $request->input('search', ''));

    $customers = Customer::query()
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nomor_hp', 'like', '%' . $search . '%')
                    ->orWhere('member_code', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('nama')
        ->paginate(10)
        ->withQueryString();

    if ($request->ajax()) {
        return response()->json([
            'html' => view(
                'admin.customers.partials.list',
                compact('customers')
            )->render(),

            'pagination' => $customers->links()->toHtml(),

            'count' => $customers->total(),
        ]);
    }

    return view('admin.customers.index', compact('customers'));
}

    public function show($id)
{
    $customer = Customer::with([
        'transactions',
        'pointHistories',
        'redemptions.reward'
    ])
    ->findOrFail($id);


    return view('admin.customers.show', compact('customer'));
}

public function edit($id)
{
    $customer = Customer::findOrFail($id);

    return view('admin.customers.edit', compact('customer'));
}



public function update(Request $request, $id)
{

    $customer = Customer::findOrFail($id);



    $validated = $request->validate([

        'nama' => [
            'required',
            'string',
            'max:255'
        ],


        'nomor_hp' => [
            'required',
            'string',
            'max:20'
        ],


        'email' => [
            'nullable',
            'email'
        ],


        'tanggal_lahir' => [
            'nullable',
            'date'
        ],


        'status_member' => [
            'required',
            'in:aktif,nonaktif'
        ]

    ]);



    $customer->update($validated);



    return redirect()
        ->route('admin.customers.show', $customer->id_customer)
        ->with('success', 'Data customer berhasil diperbarui');

}

public function updateStatus($id)
{

    $customer = Customer::findOrFail($id);


    $customer->update([

        'status_member' => 
            $customer->status_member === 'aktif'
            ? 'nonaktif'
            : 'aktif'

    ]);


    return redirect()
        ->route('admin.customers.show', $customer->id_customer)
        ->with('success', 'Status customer berhasil diperbarui');

}

public function destroy($id)
{

    $customer = Customer::findOrFail($id);


    $customer->delete();


    return redirect()
        ->route('admin.customers.index')
        ->with(
            'success',
            'Customer berhasil dihapus'
        );

}

}