<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Pages;

class PagesEdit extends Component
{
    public $title;
    public $content;
    public $slug;
    public $parent_id;
    public $page_id;

    public function mount($page)
    {
        //dd($page); 
        $this->page_id = $page->id;
        $this->title = $page->title;
        $this->content = $page->content;
        $this->parent_id = $page->parent_id;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
        ]);
        try {
            // dd($this->page_id);
            $page = Pages::firstOrNew([
                'id' => $this->page_id,
            ]);
            
            $page->title = $this->title;
            $page->content = $this->content;
            $page->parent_id = $this->parent_id;
            $page->save();
            if (!$this->page_id) {
                session()->flash('success', 'pages Updated Successfully!!');
            } else {
                session()->flash('error', 'pages Not been Updated!!');
            }
        } catch (\Exception $e) {
            dd($e);
            session()->flash('error', 'Something goes wrong while creating pages!!');
        }
        return redirect()->route('pages.index');
    }
    public function render()
    {
        return view('livewire.pages.pages-edit',[
            'pages_list' => Pages::where('id','!=',$this->page_id)->get(),
        ]);
    }
}
