<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class ComprasTest extends TestCase
{
    /**  @test */
    public function IngresoIndex()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('ingreso')
            ->assertStatus(200);
    }
    /**  @test */
    public function IngresoCreate()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('ingreso/create?id=1')
            ->assertStatus(200);
    }
       /**  @test */
       public function IngresoShow()
       {
           $user = User::find(1);
           $response = $this->actingAs($user)->get('ingreso/1')
               ->assertStatus(200);
       }

         /**  @test */
         public function IngresoEdit()
         {
             $user = User::find(1);
             $response = $this->actingAs($user)->get('ingreso/1/edit')
                 ->assertStatus(200);
         }

}
