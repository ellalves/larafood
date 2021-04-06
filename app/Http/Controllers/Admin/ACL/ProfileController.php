<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfile;

class ProfileController extends Controller
{
    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }

    protected $repository;

    public function index(Profile $profile)
    {
        $profiles = $this->repository->paginate();

        return view('admin.pages.profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    public function store(StoreUpdateProfile $request)
    {
        $profile = $this->repository->create($request->all());

        return redirect()
                        ->route('profiles.index')
                        ->with('message', 'Registro Cadastrado com sucesso!');

    }

    public function show($id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()->back()->with('success', 'Nenhum registro encontrado!');
        }

        return view('admin.pages.profiles.show', compact('profile'));
    }

    public function edit($id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()
                            ->back()
                            ->with('error', 'Nenhum registro encontrado!');
        }

        return view('admin.pages.profiles.edit', compact('profile'));
    }

    public function update(StoreUpdateProfile $request, $id)
    {
        if (!$profile = $this->repository->find($id)) {
            return redirect()
                            ->back()
                            ->with('error', 'Nenhum registro encontrado');
        }
        
        $profile->update($request->all());

        return redirect()
                        ->route('profiles.index')
                        ->with('message', 'Registro alterado com sucesso!');
    }

    public function destroy($id)
    {
        if(!$profile = $this->repository->find($id)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado');
        }

        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Registro deletado com sucesso!');
    }

    public function search (Request $request)
    {

        $filters = $request->only('filter');

        $profiles = $this->repository
                            ->where(function($query) use ($request) {
                                if($request->filter) {
                                    $query->where('name', 'LIKE', "%{$request->filter}%")
                                        ->orWhere('description', 'LIKE', "%{$request->filter}%");
                                }
                            })
                            ->paginate();
        
        return view('admin.pages.profiles.index', compact('profiles', 'filters'));
    }
}
