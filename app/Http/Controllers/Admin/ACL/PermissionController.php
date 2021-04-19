<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{

    protected $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;

        $this->middleware(['can:permissions']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->repository->paginate();

        return view('admin.pages.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('permissions.index')->with('message', 'Registro cadastrado com sucesso!');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->verifyPermission($id);

        return view('admin.pages.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->verifyPermission($id);

        return view('admin.pages.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = $this->verifyPermission($id);

        $permission->update($request->all());

        return redirect()->route('permissions.index')->with('message', 'Registro cadastrado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->verifyPermission($id);

        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Registro cadastrado com sucesso!');
    }

    public function search(Request $request) {
        $filters = $request->only('filter');

        if(!$permissions = $this->repository->search($request->filter)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        return view('admin.pages.permissions.index', compact('permissions', 'filters'));

    }

    public function verifyPermission($id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        return $permission;
    }
}
