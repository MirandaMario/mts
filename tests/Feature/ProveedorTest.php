<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class ProveedorTest extends TestCase
{
    /**  @test */
    public function ProveedorIndex()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('proveedor')
            ->assertStatus(200);
    }

    /**  @test */
    public function ProveedorCreate()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('proveedor/create')
            ->assertStatus(200);
    }

    /**  @test */
    public function ProveedorEdit()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('proveedor/1/edit')
            ->assertStatus(200);
    }

    /**  @test */
    public function ProveedorShow()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('proveedor/1')
            ->assertStatus(200);
    }

}
