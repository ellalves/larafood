<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $repository, $category;
    
    public function __construct(Product $product, Category $category)
    {
        $this->repository = $product;
        $this->category = $category;

        $this->middleware(['can:products']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate();

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProduct;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {
            $tenant = auth()->user()->tenant;
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $this->repository->create($data);

        return redirect()->route('products.index')->with('message', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->verifyProduct($id);

        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->verifyProduct($id);

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProduct;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
        $product = $this->verifyProduct($id);

        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $tenant = auth()->user()->tenant;
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $product->update($data);

        return redirect()->route('products.index')->with('message', 'Produto alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->verifyProduct($id);

        if (Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();
    
        return redirect()->route('products.index')->with('message', 'Produto deletado com sucesso!');
    }

    public function categories($idProduct)
    {
        $product = $this->verifyProduct($idProduct);

        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.index', compact('product', 'categories'));        
    }

    public function categoriesAvailable(Request $request, $idProduct)
    {
        $product = $this->verifyProduct($idProduct);
        
        $filters = $request->only('filter');

        $categories = $product->categoriesAvailable($request->filter)->paginate();

        return view('admin.pages.products.categories.available', compact('product', 'categories', 'filters'));
    }

    public function productCategoriesAttach(Request $request, $idProduct)
    {
        $product = $this->verifyProduct($idProduct);

        $categories = $request->categories; // Pega as categorias do form
        
        if (!$product || count($categories) == 0) {
            return redirect()->back()->with('info', 'Escolha, pelo menos, uma categoria');
        }

        $product->categories()->attach($categories);

        return redirect()->route('products.categories', $product->id)->with('message', 'Registro vinculado com sucesso!');        
    }    
    
    public function productCategoriesDetach($idProduct, $idCategory)
    {
        $product = $this->verifyProduct($idProduct);

        $category = $this->category->find($idCategory);
        
        if (!$product || !$category) {
            return redirect()->back()->with('info', 'Escolha, pelo menos, uma categoria');
        }

        $category->products()->detach($product);

        return redirect()->route('products.categories', $product->id)->with('message', 'Registro desvinculado com sucesso!');        
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $filters = $request->except('_token');
        $products = $this->repository->search($request->filter)->latest()->paginate();

        return view('admin.pages.products.index', compact('products', 'filters'));
    }
    
    public function verifyProduct($id) {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }
        
        return $product;
    }
}
