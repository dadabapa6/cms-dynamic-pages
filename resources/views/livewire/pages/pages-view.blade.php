<div>
<div class="">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <div><b>Title : </b>{{$pages->title}}</div>
                    <div><b>Content : </b>{{$pages->content}}</div>
                    <div><b>Slug : </b>{{$pages->slug}}</div>
                    <div><b>{{@$pages->page->title ? 'Parent : '.$pages->page->title : 'Main Page'}}</b></div>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
