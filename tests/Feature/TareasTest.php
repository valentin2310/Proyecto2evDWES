<?php

namespace Tests\Feature;

use App\Models\Empleado;
use App\Models\Tarea;
use Tests\TestCase;

class TareasTest extends TestCase
{
     public function test_tareas_index()
    {
        $response = $this->get(route('tareas.index'));
        $response->assertStatus(302);

        $empleado = Empleado::find(12);
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.index'));
        $response->assertStatus(200);
    }

    public function test_tareas_search()
    {
        $response = $this->get(route('tareas.search'));
        $response->assertStatus(302);

        $empleado = Empleado::find(12);
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

        $empleado = Empleado::find(12);
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.show', Tarea::find(23)));
        $response->assertStatus(200);
    }

    public function test_tareas_edit()
    {
        $response = $this->get(route('tareas.edit', Tarea::find(23)));
        $response->assertStatus(302);

        $empleado = Empleado::find(12);
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.edit', Tarea::find(23)));
        $response->assertStatus(200);
    }
    
    public function test_tareas_completar()
    {
        $response = $this->get(route('tareas.completar', Tarea::find(23)));
        $response->assertStatus(302);

        $empleado = Empleado::find(12);
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.completar', Tarea::find(23)));
        $response->assertStatus(200);
    }
    
    public function test_tareas_delete()
    {
        $response = $this->get(route('tareas.delete', Tarea::find(23)));
        $response->assertStatus(302);

        $empleado = Empleado::find(12);
        $this->actingAs($empleado);

        $response = $this->get(route('tareas.delete', Tarea::find(23)));
        $response->assertStatus(200);
    } 
}
