<?php

namespace App\Http\Livewire;

use App\Models\Game;
use Livewire\Component;
use Illuminate\Http\Request;

class GameGenerator extends Component
{
    public $gameId;

    protected $listeners = ['generateGame' => 'newGameGenerated'];

    public function mount()
    {
        $this->gameId = null;
    }

    public function newGameGenerated()
    {
        $game = Game::latest()->first();
        if ($game && $game->status == 0)
            $this->gameId = $game->id;
        else
            $this->gameId = null;

    }

    public function render()
    {
        return view('livewire.game-generator');
    }
}
