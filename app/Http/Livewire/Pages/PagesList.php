<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Pages;

class PagesList extends Component
{
    public $title;
    public $content;
    public $slug;
    public $parent_id;

    public function render()
    {
        // $pages = Pages::select(['title','parent_id','content','id','slug'])->with(['descendants' => function ($query) {
        //     $query->select(['title','parent_id','content','id','slug']);
        // }])->find(4); 
        // $descendants = $this->traverseTree($pages->descendants);
        $pages = Pages::with('descendants')->get();

        foreach ($pages as $key => $page) {
            $descendants = $this->traverseTree($page, collect([]));
            $page->link =  implode('/',$descendants);
        }
        return view('livewire.pages.pages-list',[
            'pages' => $pages,
        ]);
    }
    protected function traverseTree($subtree, $des)
    {
        $descendants = $des;
        if ($subtree->descendants->count() > 0) {
            foreach ($subtree->descendants as $descendant) {
                $descendants->push($descendant->slug);
                $this->traverseTree($descendant, $descendants);

            }
        }
        return array_reverse($descendants->toArray());
    }



}
