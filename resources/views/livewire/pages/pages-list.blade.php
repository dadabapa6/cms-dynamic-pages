<div>
    <a href="{{route('pages.create')}}" class="btn btn-success mb-3">Add Pages</a>
</div>
<div class="">
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Parent</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pages) > 0)
                            @foreach ($pages as $page)
                                <tr>
                                    <td>
                                        {{@$page['descendants'][0]['title']??"-"}}
                                    </td>
                                    <td>
                                        {{$page->title}}
                                    </td>
                                    <td>
                                        {{$page->content}}
                                    </td>
                                    <td>
                                        {{$page->slug}}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                        <a href="{{@$page->link.'/'.@$page->slug}}" wire:model="id" class="btn m-1 btn-success btn-sm">View</a>
                                        <a href="{{ route('pages.edit', $page->id) }}" class="btn m-1 btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('pages.destroy', $page->id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="btn m-1 btn-danger btn-sm">Delete</button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" align="center">
                                    No pages Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>