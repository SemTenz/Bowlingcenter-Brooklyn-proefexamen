<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;

class Reservations extends Component
{
    public $showCreateForm = false;
    public $showEditForm = false;
    public $reservationId;

    public function render()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('livewire.reservations', compact('reservations'));
    }

    public function showCreateForm()
    {
        $this->showCreateForm = true;
    }

    public function showEditForm($id)
    {
        $this->showEditForm = true;
        $this->reservationId = $id;
    }

    public function hideForms()
    {
        $this->showCreateForm = false;
        $this->showEditForm = false;
    }
}
