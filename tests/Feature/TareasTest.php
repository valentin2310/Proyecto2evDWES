<?php

namespace Tests\Feature;

use App\Models\Empleado;
use App\Models\Tarea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TareasTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    /* public function test_routes_exist()
    {
        $routes = [
            '/tareas',
            '/tareas/create',
            '/tareas/search',
            '/tareas/23',
            '/tareas/23/completar',
            '/tareas/23/edit',
            '/tareas/23/delete',
        ];

        foreach ($routes as $route) {

            if($route != '/tareas/create'){
                $response = $this->get($route);
                $response->assertStatus(302);
    
                $empleado = Empleado::factory()->create();
                $this->actingAs($empleado);
            }

            $response = $this->get($route);
            $response->assertStatus(200);
        }
    } */

     public function test_tareas_index()
    {
        $response = $this->get(route('tareas.index'));
        $response->assertStatus(302);

        $empleado = Empleado::factory()->create();
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.index'));
        $response->assertStatus(200);
    }

    public function test_tareas_search()
    {
        $response = $this->get(route('tareas.search'));
        $response->assertStatus(302);

        $empleado = Empleado::factory()->create();
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.search'));
        $response->assertStatus(200);
    }

    public function test_tareas_create()
    {
        $response = $this->get(route('tareas.create'));
        $response->assertStatus(200);
    }
    
    public function test_tareas_show()
    {
        $response = $this->get(route('tareas.show', Tarea::find(23)));
        $response->assertStatus(302);

        $empleado = Empleado::factory()->create();
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.show', Tarea::find(23)));
        $response->assertStatus(200);
    }
/*
    public function test_tareas_edit()
    {
        $response = $this->get(route('tareas.edit', ['id' => 23]));
        $response->assertStatus(302);

        $empleado = Empleado::factory()->create();
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.edit'), ['id' => 23]);
        $response->assertStatus(200);
    }
    
    public function test_tareas_completar()
    {
        $response = $this->get(route('tareas.completar', ['id' => 23]));
        $response->assertStatus(302);

        $empleado = Empleado::factory()->create();
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.completar'), ['id' => 23]);
        $response->assertStatus(200);
    }
    
    public function test_tareas_delete()
    {
        $response = $this->get(route('tareas.delete', ['id' => 23]));
        $response->assertStatus(302);

        $empleado = Empleado::factory()->create();
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.delete'), ['id' => 23]);
        $response->assertStatus(200);
    } */
}
