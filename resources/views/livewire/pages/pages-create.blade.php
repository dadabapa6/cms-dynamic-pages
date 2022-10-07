<div>
    <div class="">
        <div class="card">
            <div class="card-body">
                <form>
                    <select class="form-select select2 mb-4" id="parent_id" wire:model.lazy="parent_id">
                        <option value="">Select Parant</option>
                        @forelse(@$pages as $page)
                            <option value="{{$page->id}}">{{$page->title}}</option>
                        @empty
                            <option value="" disabled>No record found</option>
                        @endforelse
                    </select>
                    <div class="form-group mb-3">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title" wire:model.lazy="title">
                        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="content">Content:</label>
                        <input type="text" class="form-control" id="content" placeholder="Enter Content" wire:model.lazy="content">
                        @error('content') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button wire:click.prevent="store()" class="btn btn-success btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>