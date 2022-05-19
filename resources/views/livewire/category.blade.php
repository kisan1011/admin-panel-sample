<div>
    @include('livewire.createcategory')
    @include('livewire.updatecategory')
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
          {{ session('message') }}
        </div>
    @endif
    <button class="btn btn-primary float-right" id="add_category_btn" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fas fa-plus"></i> Add Category</button>
    <br><br>
    <div class="col-md-12 table-responsive">
        <table id="tbl_categories" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td><img src="{{ asset('storage/app/public').'/'.$post->image }}" width="50" height="50" style="object-fit:cover;"></td>
                    <td>{{ $post->name }}</td>
                    <td>
                    <button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $post->id }})" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $post->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
