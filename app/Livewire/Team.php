<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member;
class Team extends Component
{
    public function render()
    {
        
        $members = Member::orderBy('name','ASC')->get();
        return view('livewire.team',['members'=>$members]);
    }
}
