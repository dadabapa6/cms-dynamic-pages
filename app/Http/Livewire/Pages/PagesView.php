<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Pages;

class PagesView extends Component
{
    public $page_id;
    public function mount($page)
    {
        //dd($page->id);
        $this->page_id = $page->id;
    }
    public function store()
    {

        try {
            $pages = Pages::firstOrNew([
                'id' => $this->page_id,
            ]);
        } catch (\Throwable $th) {
            $this->emit('notification', ['type' => 'error', 'message' => 'not found']);
            return true;
        }
    }
    public function render()
    {
        $pages = Pages::with('page')->where('id',$this->page_id)->first();
        return view('livewire.pages.pages-view',[
            'pages' => $pages,
        ]);
    }
}
