<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class StaticPage extends Component
{
    public $pageId = null;
    public function mount($id){
        $this->pageId= $id;
    }

    public function render()
    {
        $page = Page::findOrFail($this->pageId);

        return view('livewire.static-page',[
            'page'=> $page
        ]);
    }
}
