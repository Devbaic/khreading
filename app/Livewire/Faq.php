<?php

namespace App\Livewire;
use App\Models\Faqs;
use Livewire\Component;

class Faq extends Component
{
    public function render()
    {

        $faqs=Faqs::orderBy('question','ASC')->get();
        return view('livewire.faq',['faqs'=> $faqs]);
    }
}
