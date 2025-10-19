<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Abouts;
use App\Models\Member;
class About extends Component
{
    public function render()
    {
        $abouts=Abouts::orderBy('title','ASC')->get();
        $teams=Member::orderBy('name','ASC')->get();
        return view('livewire.about',
            ['teams'=>$teams],['abouts'=>$abouts]);
    }
}
