<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $entity;

    public function __construct(User $User)
    {
        $this->entity = $User;
    }

    public function searchUser(int $idTenant, string $filter)
    {
        return $this->entity->where('tenant_id', $idTenant)
                            ->whereHas('roles', function ($query) {
                                $query->where('name', 'Entregador');
                            })
                            ->where('name', 'LIKE',  "%{$filter}%")
                            ->orWhere('document', 'LIKE', "%{$filter}%")
                            ->withoutGlobalScope(TenantScope::class)
                            ->paginate(10);
    }

    // public function createUser(array $data)
    // {
    //     //Inicia o Database Transaction
    //     DB::beginTransaction();

    //     if (empty($data['password']))
    //     {
    //         $data['password'] = Str::random(8);
    //     }
    //     $User = $this->entity->create($data);
        
    //     if($User->addAddress($data['address']))
    //     {
    //         //Sucesso!
    //         DB::commit();
    //         return $User;
    //     }

    //     //Fail, desfaz as alterações no banco de dados
    //     DB::rollBack();
    // }

    public function getUserUuidByTenantId(int $idTenant, string $uuidUser)
    {
        return $this->entity->where('tenant_id', $idTenant)
                            ->where('uuid', $uuidUser)
                            ->withoutGlobalScope(TenantScope::class)
                            ->first();
    }
}