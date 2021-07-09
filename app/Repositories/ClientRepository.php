<?php
namespace App\Repositories;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    protected $entity;

    public function __construct(Client $client)
    {
        $this->entity = $client;
    }

    public function searchClient(string $filter)
    {
        return $this->entity->search($filter);
    }

    public function createClient(array $data)
    {
        //Inicia o Database Transaction
        DB::beginTransaction();

        if (empty($data['password']))
        {
            $data['password'] = Str::random(8);
        }
        $client = $this->entity->create($data);
        
        if($client->addAddress($data['address']))
        {
            //Sucesso!
            DB::commit();
            return $client;
        }

        //Fail, desfaz as alterações no banco de dados
        DB::rollBack();
    }

    public function getClient(string $uuid)
    {

    }
}