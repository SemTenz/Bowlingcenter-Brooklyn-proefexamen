<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Reservation;
use App\Models\Options;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_a_reservation()
    {
        $options = Options::factory()->create();
        
        $data = [
            'date' => '2024-04-05',
            'time' => '12:00',
            'people' => 4,
            'phone' => '123456789',
            'name' => 'John Doe',
            'menu' => $options->id,
            'user_id' => null,
        ];

        $response = $this->post(route('reservations.store'), $data);

        $response->assertRedirect(route('reservations.index'));
        $this->assertDatabaseHas('reservations', $data);
    }

    /** @test */
    public function it_updates_a_reservation()
    {
        $reservation = Reservation::factory()->create();
        $options = Options::factory()->create();

        $data = [
            'date' => '2024-04-06',
            'time' => '14:00',
            'people' => 6,
            'phone' => '987654321',
            'name' => 'Jane Doe',
            'menu' => $options->id,
            'user_id' => null,
        ];

        $response = $this->put(route('reservations.update', $reservation->id), $data);

        $response->assertRedirect(route('reservations.index'));
        $this->assertDatabaseHas('reservations', $data);
    }

    /** @test */
    public function it_deletes_a_reservation()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->delete(route('reservations.destroy', $reservation->id));

        $response->assertRedirect(route('reservations.index'));
        $this->assertDatabaseMissing('reservations', ['id' => $reservation->id]);
    }
}
