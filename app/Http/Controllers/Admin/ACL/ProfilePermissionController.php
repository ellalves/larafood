<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilePermissionController extends Controller
{
    protected $profile, $permission;
    
    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
 
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.index', compact('profile', 'permissions'));
    }

    public function profiles ($idPermission) {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.index', compact('profiles', 'permission'));
    }

    public function permissionsAvailable(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }
        
        $filters = $request->except('_token');

        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters'));
    }

    public function profilePermissionsAttach(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $permissions = $request->permissions;

        if(!$permissions || count($permissions) == 0){
            return redirect()->back()->with('info', 'Escolha, pelo menos, uma permissão!');
        }

        $profile->permissions()->attach($permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function profilePermissionsDetach ($idProfile, $idPermission) 
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id)->with('message', 'Registro desvinculado com sucesso!');
    }
}
