<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->middleware(['can:users']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
                
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = bcrypt( Str::random(8) );
        }

        $user = $this->user->create($data);

        return redirect()->route('users.index')->with('message', __('messages.store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->verifyUser($id);

        return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->verifyUser($id);

        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {
        $user = $this->verifyUser($id);

        $data = $request->all();
        
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->birth) {
            $data['birth'] = implode('-', array_reverse(explode('/', $request->birth)));
        }

        $user->update($data);

       $routeBack = $request->user()->isAdmin() ? 'users.index' : 'users.profile';

        return redirect()->route($routeBack)->with('message', __('messages.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->verifyUser($id);

        // Impedir Auto-destruição
        if($id == auth()->user()->id){
            return redirect()->back()->with('error', __('messages.impossible_to_remove'));
        }

        $user->delete();

        return redirect()->route('users.index')->with('message', __('messages.delete_success'));
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $users = $this->user->search($request->filter)->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }

    public function profile($username)
    {
       if (! $user = $this->user->userProfile($username)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
       }

       $addresses = $user->addresses();

       return view('admin.pages.users.profile', compact('user', 'addresses'));
    }

    /**
     * Verify User
     */
    public function verifyUser($id)
    {
        if (!$user = $this->user->tenantUser()->findOrFail($id)) {
            return redirect()->back()->with('error', __('messages.empty_register'));
        }

        return $user;
    }
}
