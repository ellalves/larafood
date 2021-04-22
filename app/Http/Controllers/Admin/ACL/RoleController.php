<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;

class RoleController extends Controller
{
    protected $repository;

    public function __construct(Role $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:roles']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->repository->latest()->paginate();

        return view('admin.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRole;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRole $request)
    {
        $role = $this->repository->create($request->all());

        return redirect()->route('roles.index')->with('message', __('messages.store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->verifyRole($id);

        return view('admin.pages.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->verifyRole($id);

        return view('admin.pages.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRole;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRole $request, $id)
    {
        $role = $this->verifyRole($id);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', __('messages.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->verifyRole($id);

        $role->delete();

        return redirect()->route('roles.index')->with('success', __('messages.delete_success'));
    }

    public function verifyRole($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $role;
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $roles = $this->repository->where(function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->filter}%");
            $query->orWhere('description', 'LIKE', "%{$request->filter}%");
        })
        ->latest()
        ->paginate();

        return view('admin.pages.roles.index', compact('roles', 'filters'));
    }
}
