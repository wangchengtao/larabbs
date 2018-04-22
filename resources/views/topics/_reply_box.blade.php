@include('common.error')

<div class="reply-box">
    <form action="{{ route('replies.store') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">

        <div class="form-group">
            <textarea name="reply_content" id="content" cols="3" placeholder="分享你的想法" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-share"></i>回复</button>
    </form>
</div>