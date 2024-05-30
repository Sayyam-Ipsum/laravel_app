<table class="table table-striped table-hover">
    <thead class="bg-light">
    <tr>
        <th width="5%">Sr.</th>
        <th width="10%">Created At</th>
        <th width="70%">Post</th>
        <th width="15%">Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($posts))
        @foreach($posts as $key => $post)
            <tr>
                <td width="5%">{{$key + 1}}</td>
                <td width="10%">{{showDateTime($post->created_at)}}</td>
                <td width="70%">{{$post->text}}</td>
                <td width="15%">
                    <a href='{{route('post.modal', ['id' => $post->id])}}' class="btn btn-sm btn-success">Edit</a>
                    <button class="btn btn-sm btn-danger btn-delete-post" data-id="{{$post->id}}">Delete</button>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4" class="text-center">No posts found!</td>
        </tr>
    @endif
    </tbody>
</table>
