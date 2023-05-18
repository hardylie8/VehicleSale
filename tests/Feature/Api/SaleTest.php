<?php

namespace Tests\Feature\Api;

use App\Models\Sale;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Current endpoint url which being tested.
     *
     * @var string
     */
    protected $endpoint = '/api/sale/';

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
        $this->model = Sale::factory()->create();
        $this->header = $this->getTokenHeaders();
    }

    /** @test */
    public function index_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint, $this->header)
            ->assertStatus(200)
            ->assertJsonFragment([
                'total' => $this->model->getAttribute('total'),
                'vehicle_id' => $this->model->getAttribute('vehicle_id'),
            ]);
    }

    /** @test */
    public function show_endpoint_works_as_expected()
    {
        $this->getJson($this->endpoint . $this->model->getKey(), $this->header)
            ->assertStatus(200)
            ->assertJsonFragment([
                'total' => $this->model->getAttribute('total'),
                'vehicle_id' => $this->model->getAttribute('vehicle_id'),
            ]);
    }

    /** @test */
    public function create_endpoint_works_as_expected()
    {
        $vehicle = Vehicle::factory()->create();
        $data = Sale::factory([
            'total' => $vehicle->stock - 4,
            'vehicle_id' => $vehicle->_id,
        ])->raw();

        // The data which should be shown
        $seenData = $data;
        $this->postJson($this->endpoint, $data, $this->header)
            ->assertStatus(200)
            ->assertJsonFragment($seenData);
    }

}
