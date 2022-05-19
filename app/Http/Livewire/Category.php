<?php

namespace App\Http\Livewire;

use App\Models\Categories;
use Livewire\Component;
use Livewire\WithFileUploads;

class Category extends Component
{
    use WithFileUploads;
    public $category, $name, $image, $category_id,$hidden_image;
    public $updateMode = false;
    public function render()
    {
        $this->category = Categories::all();

        return view('livewire.category');
    }

    private function resetInputFields(){
        $this->name = '';
        $this->image = '';
    }

    public function store()
    {
        $dataValid = $this->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        $dataValid['image'] = $this->image->store('image','public');

        Categories::create($dataValid);

        session()->flash('message', 'Category Added Successfully.');

        $this->resetInputFields();

        $this->emit('userStore'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $category = Categories::where('id',$id)->first();
        $this->category_id = $id;
        $this->name = $category->name;
        $this->image = storage_path('app/public/').$category->image;
        $this->hidden_image = $category->image;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            //'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        if ($this->category_id) {
            $user = Categories::find($this->category_id);

            if($this->hidden_image){
                $img = $this->hidden_image;
            }else{
                $img = $this->image->store('image','public');
            }

            $user->update([
                'name' => $this->name,
                'image' => $img
            ]);

            $this->updateMode = false;
            session()->flash('message', 'Category Updated Successfully.');

            //$this->resetInputFields();
            $this->emit('userStore');
        }
    }

    public function delete($id)
    {
        if($id){
            Categories::where('id',$id)->delete();
            session()->flash('message', 'Category Deleted Successfully.');
        }
    }
}
