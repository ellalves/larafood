<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Cashier\Billable;
use App\Models\Traits\UserACLTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Lecturize\Addresses\Traits\HasAddresses;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserACLTrait, Billable, HasAddresses;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_id',
        'tenant_id',
        'uuid',
        'name',
        'document',
        'username',
        'email',
        'phone',
        'password',
        'birth',
        'sex',
        'bio',
        'photo',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function userProfile($username)
    {
       return $this->with(['tenant', 'roles'])
                    ->where('username', $username)
                    ->orWhere('phone', $username)
                    ->first();
    }
    public function userRoleAvailable($filter = null)
    {
        return Role::whereNotIn('roles.id', function ($query) {
            $query->select('ur.role_id');
            $query->from('role_user AS ur');
            $query->whereRaw("ur.user_id={$this->id}");
        })
        ->where(function($query) use ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        });
    }

    public function search($filter = null)
    {
        $users = $this->join('tenants', 'tenants.id', '=', 'users.tenant_id')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('users.name', 'LIKE', "%{$filter}%");
                    $query->orWhere('tenants.name', 'LIKE', "%{$filter}%");
                }
            })
            ->select('users.*')
            ->latest()
            ->with('tenant')
            ->tenantUser();
    
        return $users;
    }

    public function getAccessEndAttribute()
    {
        $accessEndAt = $this->subscription('default')->ends_at;

        return Carbon::make($accessEndAt)->format("d/m/Y à\s H:i:s");
    }

    public function getCreatedAttribute()
    {
        return Carbon::make($this->created_at)->format("d/m/Y à\s H:i:s");
    }

    public function getUpdatedAttribute()
    {
        return Carbon::make($this->updated_at)->format("d/m/Y à\s H:i:s");
    }

    public function getBirthDateAttribute()
    {
        return Carbon::make($this->birth)->format("d/m/Y");
    }
    
    public function plan()
    {
        $stripe_plan = $this->subscription('default')->stripe_plan;

        return Plan::where('stripe_id', $stripe_plan)->first();
    }

    public function adminlte_profile_url()
    {
        $username = auth()->user()->username ?? auth()->user()->phone;
        return route('users.profile', $username);
    }

    public function adminlte_image()
    {
        return auth()->user()->photo ?? url('images/user-profile-none.png');
    }

    public function adminlte_desc()
    {
        return auth()->user()->bio;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser(Builder $query)
    {
        // Retorna as usuarios da tenant atual
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

}
