<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['tenant_id', 'identify', 'client_id', 'table_id', 'total', 'status', 'comment'];

    /**
     * Options status
     */
    public $statusOptions = [
        'open' => 'Aberto',
        'done' => 'Completo',
        'rejected' => 'Rejeitado',
        'working' => 'Andamento',
        'canceled' => 'Cancelado',
        'delivering' => 'Em transito',
    ];
    
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class)->withDefault();
    }

    public function table()
    {
        return $this->belongsTo(Table::class)->withDefault();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['price', 'qty']);
    }
}
