<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class CorizacionTest extends TestCase
{
    /**  @test */
    public function CotizacionIndex()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/cotizacion')
            ->assertStatus(200);
    }

     /**  @test */
     public function CotizacionEdit()
     {
         $user = User::find(1);
         $response = $this->actingAs($user)->get('/cotizacion/1/edit')
             ->assertStatus(200);
     }    
     
     /**  @test */
     public function CotizacionPDF()
     {
         $user = User::find(1);
         $response = $this->actingAs($user)->get('/cotizacion/1')
             ->assertStatus(200);
     }


 

}
