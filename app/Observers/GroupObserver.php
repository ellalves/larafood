<?php

namespace App\Observers;

use App\Models\Group;
use Illuminate\Support\Str;

class GroupObserver
{
    /**
     * Handle the Group "creating" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function created(Group $group)
    {
        $group->uuid = Str::uuid();
    }

    /**
     * Handle the Group "updating" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function updated(Group $group)
    {
        //
    }
}
