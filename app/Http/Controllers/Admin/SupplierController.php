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

    public function index()
    {
        $suppliers = Supplier::latest()->get();

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
}