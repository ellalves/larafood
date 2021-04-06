<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanProfileController extends Controller
{
    protected $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function profiles ($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('Nenhum registro encontrado!');
        }

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.index', compact('plan', 'profiles'));
    }

    public function profilesAvailable(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()-with('error', 'Nenhum registro encontrado!');
        }

        $filters = $request->except('_token');

        $profiles = $plan->profilesAvailable($request->filter)->paginate();

        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'filters'));
    }

    public function planProfilesAttach(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan)) {
            return redirect()->back()->with('error', 'Nenhum registro encontrado!');
        }

        $profiles = $request->profiles;

        if (!$profiles || count($profiles) == 0) {
            return redirect()->back()->with('info', 'Escolha, pelo menos, um perfil');
        }

        $plan->profiles()->attach($profiles);

        return redirect()->route('plans.profiles', $plan->id)->with('Registro vinculado com sucesso!');
    }

    public function planProfilesDetach ($idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if (!$plan || !$profile) {
            return redirect()->back()->with('info', 'Escolha, pelo menos, um perfil');
        }

        $profile->plans()->detach($plan);

        return redirect()->route('plans.profiles', $plan->id)->with('message', 'Registro desvinculado com sucesso!');
    }
}