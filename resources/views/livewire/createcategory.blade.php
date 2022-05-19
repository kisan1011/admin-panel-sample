<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Category<span class="red">*</span></label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter category" wire:model="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-form-label">Image:</label>
                        <input type="file" wire:model="image" id="image" class="form-control" placeholder="Select Image" onchange="load_preview_image(this);" accept="image/x-png,image/jpg,image/jpeg">
                        @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-md-6" id="preview_div" style="display: none">
                        <img src="" id="image_preview">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
