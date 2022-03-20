<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class CorteTest extends TestCase
{
    /**  @test */
    public function CorteIndex()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('corte')
            ->assertStatus(200);
    }

}
