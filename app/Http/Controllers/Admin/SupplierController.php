<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST SUPPLIER
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Supplier::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $suppliers = $query->latest()->get();

        return view(
            'admin.suppliers.index',
            compact('suppliers')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.suppliers.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE SUPPLIER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'email' => [
                'nullable',
                'email'
            ],

        ]);

        Supplier::create($validated);

        return redirect()
            ->route('admin.suppliers.index')
            ->with(
                'success',
                'Supplier berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT SUPPLIER
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $supplier = Supplier::with('products')->findOrFail($id);
        $allProducts = \App\Models\Product::with('supplier')->orderBy('name')->get();

        return view('admin.suppliers.edit', compact('supplier', 'allProducts'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE SUPPLIER
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],
            'address' => [
                'nullable',
                'string'
            ],
            'email' => [
                'nullable',
                'email'
            ],
            'products' => [
                'nullable',
                'array'
            ],
            'products.*' => [
                'integer',
                'exists:products,id'
            ]
        ]);

        $supplier->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'email' => $validated['email'],
        ]);

        // Detach products currently belonging to this supplier
        \App\Models\Product::where('supplier_id', $supplier->id)->update(['supplier_id' => null]);

        // Attach selected products to this supplier
        if ($request->has('products')) {
            \App\Models\Product::whereIn('id', $request->input('products'))->update(['supplier_id' => $supplier->id]);
        }

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY SUPPLIER
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}