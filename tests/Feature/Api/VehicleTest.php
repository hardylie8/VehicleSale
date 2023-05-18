<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Current endpoint url which being tested.
     *
     * @var string
     */
    protected $endpoint = '/api/vehicle/';

    /**
     * Faker generator instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * The model which being tested.
     *
     * @var News
     */
    protected $model;

    /**
     * Currently logged in User JWT Token.
     *
     * @var Array
     */
    protected $header;

    /**
     * Setup the test environment.
     *
     * return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->model = Vehicle::factory()->create();
        $this->header = $this->getTokenHeaders();
    }

    /** @test */
    public function index_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint, $this->header)
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $this->model->getAttribute('name'),
                'year' => $this->model->getAttribute('year'),
                'price' => $this->model->getAttribute('price'),
                'color' => $this->model->getAttribute('color'),
                'stock' => $this->model->getAttribute('stock'),
                'car_id' => $this->model->getAttribute('car_id'),
                'motorcycle_id' => $this->model->getAttribute('motorcycle_id'),
            ]);
    }

    /** @test */
    public function show_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint . $this->model->getKey(), $this->header)
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $this->model->getAttribute('name'),
                'year' => $this->model->getAttribute('year'),
                'price' => $this->model->getAttribute('price'),
                'color' => $this->model->getAttribute('color'),
                'stock' => $this->model->getAttribute('stock'),
                'car_id' => $this->model->getAttribute('car_id'),
                'motorcycle_id' => $this->model->getAttribute('motorcycle_id'),
            ]);
    }

    /** @test */
    public function create_endpoint_works_as_expected()
    {
        // Submitted data
        $data = Vehicle::factory()->raw();

        // The data which should be shown
        $seenData = $data;

        $this->postJson($this->endpoint, $data, $this->header)
            ->assertStatus(200)
            ->assertJsonFragment($seenData);
    }

    /** @test */
    public function update_endpoint_works_as_expected()
    {
        // Submitted data
        $data = Vehicle::factory()->raw();

        // The data which should be shown
        $seenData = $data;

        $this->patchJson($this->endpoint . $this->model->getKey(), $data, $this->header)
            ->assertStatus(200)
            ->assertJsonFragment($seenData);
    }

    /** @test */
    public function delete_endpoint_works_as_expected()
    {
        $this->deleteJson($this->endpoint . $this->model->getKey(), $this->header)
            ->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Data Has been successfully deleted',
            ]);

        $this->assertDatabaseHas('vehicles', [
            "name" => $this->model->name,
            "year" => $this->model->year,
            "price" => $this->model->price,
            "color" => $this->model->color,
            "stock" => $this->model->stock,
            "car_id" => $this->model->car_id,
            "motorcycle_id" => $this->model->motorcycle_id,
        ]);

        $this->assertDatabaseMissing('vehicles', [
            "name" => $this->model->name,
            "year" => $this->model->year,
            "price" => $this->model->price,
            "color" => $this->model->color,
            "stock" => $this->model->stock,
            "car_id" => $this->model->car_id,
            "motorcycle_id" => $this->model->motorcycle_id,
            'deleted_at' => null,
        ]);
    }
}
