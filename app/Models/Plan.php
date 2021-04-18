<?php

namespace App\Models;

use App\Models\DetailPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $table = "plans";

    protected $fillable = ['name', 'url', 'price', 'description'];

    public function details() 
    {
        return $this->hasMany(DetailPlan::class); 
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'plan_group');
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function search($filter = null) 
    {
        $results = $this->where('name', 'LIKE',  "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();

        return $results;
    }

    public function groupsAvailable($filter = null )
    {
        $groups = Group::whereNotIn('id', function($query) {
            $query->select('plan_group.group_id');
            $query->from('plan_group');
            $query->whereRaw("plan_group.plan_id={$this->id}");
        })

        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('groups.name', 'LIKE', "%{$filter}%");
        });

        return $groups;
    }
}
