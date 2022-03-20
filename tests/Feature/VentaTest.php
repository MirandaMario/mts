<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User; 

class VentaTest extends TestCase
{
  
    public function testIndexVenta()
    {
        $user = User::find(1); 
        $response = $this->actingAs($user)->get('/venta')
                       ->assertStatus(200);
    }

    public function testTicketVenta()
    {
        $user = User::find(1); 
        $response = $this->actingAs($user)->get('/venta/create?id=1')
                       ->assertStatus(200);
    }

    public function testFacturaVenta()
    {
        $user = User::find(1); 
        $response = $this->actingAs($user)->get('/venta/create?id=2')
                       ->assertStatus(200);
    }

    public function testCCFVenta()
    {
        $user = User::find(1); 
        $response = $this->actingAs($user)->get('/venta/create?id=3')
                       ->assertStatus(200);
    }

    public function testVentaShowTicketFacturaCCF()
    {
        $user = User::find(1); 
        $response = $this->actingAs($user)->get('/venta/1')
                       ->assertStatus(200);
    }
}
