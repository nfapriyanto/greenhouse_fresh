<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;

class ManageProducts extends Component
{
    use WithFileUploads;

    public $products, $name, $price, $description, $image, $product_id;
    public $isEdit = false;

    protected $rules = [
        'name' => 'required|string',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:1024',
    ];

    public function render()
    {
        $this->products = Product::latest()->get();
        return view('livewire.manage-products');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->price = '';
        $this->description = '';
        $this->image = null;
        $this->product_id = null;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('products', 'public') : null;

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        $this->dispatchBrowserEvent('notify', 'Produk berhasil ditambahkan!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);
        $imagePath = $product->image;

        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        $product->update([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        $this->dispatchBrowserEvent('notify', 'Produk berhasil diperbarui!');
        $this->resetFields();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('notify', 'Produk berhasil dihapus!');
    }
}
