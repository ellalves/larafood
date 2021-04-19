<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Group;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupPermissionController extends Controller
{
    protected $group, $permission;
    
    public function __construct(Group $group, Permission $permission)
    {
        $this->group = $group;
        $this->permission = $permission;

        $this->middleware(['can:groups']);
    }

    /**
     * Groups x Permission
     */
    public function groups ($idPermission) {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back();
        }

        $groups = $permission->groups()->paginate();

        return view('admin.pages.permissions.groups.index', compact('groups', 'permission'));
    }
    
    public function groupsAvailable(Request $request, $idPermission)
    {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }
        
        $filters = $request->except('_token');

        $groups = $permission->groupsAvailable($request->filter);

        return view('admin.pages.permissions.groups.available', compact('groups', 'permission', 'filters'));
    }

    public function groupPermissionsAttach(Request $request, $idGroup)
    {
        if (!$group = $this->group->find($idGroup)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $permissions = $request->permissions;

        if(!$permissions || count($permissions) == 0){
            return redirect()->back()->with('info', 'Escolha, pelo menos, uma permissão!');
        }

        $group->permissions()->attach($permissions);

        return redirect()->route('groups.permissions', $group->id);
    }

    public function groupPermissionsDetach ($idGroup, $idPermission) 
    {
        $group = $this->group->find($idGroup);
        $permission = $this->permission->find($idPermission);

        if (!$group || !$permission) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $group->permissions()->detach($permission);

        return redirect()->route('groups.permissions', $group->id)->with('message', 'Registro desvinculado com sucesso!');
    }

    /**
     * Permission x groups
     */

    public function permissions($idGroup)
    {
 
        if (!$group = $this->group->find($idGroup)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $permissions = $group->permissions()->paginate();

        return view('admin.pages.groups.permissions.index', compact('group', 'permissions'));
    }

    public function permissionsAvailable(Request $request, $idGroup)
    {
        if (!$group = $this->group->find($idGroup)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }
        
        $filters = $request->except('_token');

        $permissions = $group->permissionsAvailable($request->filter)->paginate();

        return view('admin.pages.groups.permissions.available', compact('group', 'permissions', 'filters'));
    }

    public function permissionsGroupAttach(Request $request, $idPermission)
    {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $groups = $request->groups;

        if(!$groups || count($groups) == 0){
            return redirect()->back()->with('info', 'Escolha, pelo menos, um grupo!');
        }

        $permission->groups()->attach($groups);

        return redirect()->route('permissions.groups', $permission->id);
    }

    public function permissionGroupsDetach ($idGroup, $idPermission) 
    {
        $group = $this->permission->find($idGroup);
        $permission = $this->permission->find($idPermission);

        if (!$group || !$permission) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $permission->groups()->detach($group);

        return redirect()->route('groups.permissions', $permission->id)->with('message', 'Registro desvinculado com sucesso!');
    }
}
