<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(Category $category)
    {
        $this->repository = $category;

        $this->middleware(['can:categories']);     
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->latest()->paginate();

        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateCategory;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategory $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('categories.index')->with('message', __('messages.store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->verifyCategory($id);

        return view('admin.pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->verifyCategory($id);

        return view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateCategory;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategory $request, $id)
    {
        $category = $this->verifyCategory($id);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('message', __('messages.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->verifyCategory($id);

        $category->delete();

        return redirect()->route('categories.index')->with('message', __('messages.delete_success'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $categories = $this->repository->search($request->filter)->latest()->paginate();

        return view('admin.pages.categories.index', compact('categories', 'filters'));
    }

    public function verifyCategory($id)
    {
        if (!$category = $this->repository->findOrFail($id)) {
            return redirect()->back()->with('error',  __('messages.empty_register'));
        }

        return $category;
    }
}
