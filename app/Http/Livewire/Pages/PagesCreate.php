<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Pages;

class PagesCreate extends Component
{
    public $title;
    public $content;
    public $slug;
    public $parent_id;

    public function resetFields()
    {
        $this->title = '';
        $this->content = '';
        $this->slug = '';
        $this->parent_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
        ]);    
        try {
            Pages::create([
                'title' => $this->title,
                'content' => $this->content,
                'parent_id' => $this->parent_id,
                'slug' => $this->fixForUri($this->title),
            ]);
            session()->flash('success', 'Page Created Successfully!!');
            $this->resetFields();
        } catch (\Exception $e) {
            session()->flash('error', 'Something goes wrong while creating page!');
            $this->resetFields();
        }
        return redirect()->route('pages.index');
    }
    public function render()
    {
        return view('livewire.pages.pages-create',[
            'pages' => Pages::all(),
        ]);
    }
    public function fixForUri($text,string $divider = '-') {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
