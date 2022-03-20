<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class ArticulosTest extends TestCase
{
    /**  @test */
    public function ArticuloShow()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('articulo/show3/1')
            ->assertStatus(200);
    }
    /**  @test */
    public function Art1culoEdit()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('articulo/1/edit')
            ->assertStatus(200);
    }

       /**  @test */
       public function ArticuloIndex()
       {
           $user = User::find(1);
           $response = $this->actingAs($user)->get('articulo')
               ->assertStatus(200);
       }

}
