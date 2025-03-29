<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Member;
use App\Models\Service;
use Livewire\Component;

class ShowHome extends Component
{
    public function render()
    {

        $paginate = 10;
        $members = Member::orderBy('name','ASC')->get();


        $query = Article::orderBy('created_at', 'desc');
        $articles = $query->paginate($paginate);



        $services = Service::orderBy('title','asc')->get();
        return view('livewire.show-home',[
            'services'=> $services,
            'articles' => $articles,
            'members'=> $members

        ]);


    }

}
