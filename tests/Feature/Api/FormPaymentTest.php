<?php

namespace Tests\Feature\Api;

use App\Models\FormPayment;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected $url = 'api/v1';

    /**
     * Error Get Form Payment By Tenant.
     *
     * @return void
     */
    public function testErrorGetFormPaymentByTenant()
    {
        $urlTenant = Tenant::factory()->create()->url;

        $urlFormPayment = "fake_value";

        $response = $this->get("{$this->url}/tenants/{$urlTenant}/form-payments/{$urlFormPayment}");

        // $response->dump();

        $response->assertStatus(400);
    }

    /**
     * Get Form Payment By Tenant.
     *
     * @return void
     */
    public function testGetFormPaymentByTenant()
    {
        $urlTenant = Tenant::factory()->create()->url;

        $formPayment = FormPayment::factory()->create()->url;

        $response = $this->get("{$this->url}/tenants/{$urlTenant}/form-payments/{$formPayment}");

        $response->dump();

        $response->assertStatus(200);
    }
}
