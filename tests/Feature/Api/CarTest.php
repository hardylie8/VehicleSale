<?php

namespace Tests\Feature\Api;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CarTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Current endpoint url which being tested.
     *
     * @var string
     */
    protected $endpoint = '/api/car/';

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
        $this->model = Car::factory()->create();
        $this->header = $this->getTokenHeaders();
    }

    /** @test */
    public function index_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint, $this->header)
            ->assertStatus(200)
            ->assertJsonFragment([
                'engine' => $this->model->getAttribute('engine'),
                'capacity' => $this->model->getAttribute('capacity'),
                'type' => $this->model->getAttribute('type'),
            ]);
    }

    /** @test */
    public function show_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint . $this->model->getKey(), $this->header)
            ->assertStatus(200)
            ->assertJsonFragment([
                'engine' => $this->model->getAttribute('engine'),
                'capacity' => $this->model->getAttribute('capacity'),
                "type" => $this->model->getAttribute('type'),
            ]);
    }

    /** @test */
    public function create_endpoint_works_as_expected()
    {
        // Submitted data
        $data = Car::factory()->raw();

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
        $data = Car::factory()->raw();

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

        $this->assertDatabaseHas('cars', [
            "engine" => $this->model->engine,
            "capacity" => $this->model->capacity,
            "type" => $this->model->type,
        ]);

        $this->assertDatabaseMissing('cars', [
            "engine" => $this->model->engine,
            "capacity" => $this->model->capacity,
            "type" => $this->model->type,
            'deleted_at' => null,
        ]);
    }
}
