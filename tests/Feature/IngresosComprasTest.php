<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User; 

class IngresosComprasTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIngresoIndex()
    {   
        $user = User::find(1); 
        $response = $this->actingAs($user)->get('/ingreso')
                       ->assertStatus(200);
    }

    public function testIngresoCreate()
    {   
        $user = User::find(1); 
        $response = $this->actingAs($user)->get('/ingreso/create')
                       ->assertStatus(200);
    }


    public function testIngresoCreate2()
    {   
        $user = User::find(1); 
        $response = $this->actingAs($user)->get('/ingreso/create2')
                       ->assertStatus(200);
    }
}
