<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanGroupController extends Controller
{
    protected $plan, $group;

    public function __construct(Plan $plan, Group $group)
    {
        $this->plan = $plan;
        $this->group = $group;
    }

    public function groups ($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('Nenhum registro encontrado!');
        }

        $groups = $plan->groups()->paginate();

        return view('admin.pages.plans.groups.index', compact('plan', 'groups'));
    }

    public function groupsAvailable(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $filters = $request->except('_token');

        $groups = $plan->groupsAvailable($request->filter)->paginate();

        return view('admin.pages.plans.groups.available', compact('plan', 'groups', 'filters'));
    }

    public function planGroupsAttach(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $groups = $request->groups;

        if (!$groups || count($groups) == 0) {
            return redirect()->back()->with('info', 'Escolha, pelo menos, um perfil');
        }

        $plan->groups()->attach($groups);

        return redirect()->route('plans.groups', $plan->id)->with('Registro vinculado com sucesso!');
    }

    public function planGroupsDetach ($idPlan, $idGroup)
    {
        $plan = $this->plan->find($idPlan);
        $group = $this->group->find($idGroup);

        if (!$plan || !$group) {
            return redirect()->back()->with('info', 'Escolha, pelo menos, um grupo');
        }

        $group->plans()->detach($plan);

        return redirect()->route('plans.groups', $plan->id)->with('message', 'Registro desvinculado com sucesso!');
    }
}