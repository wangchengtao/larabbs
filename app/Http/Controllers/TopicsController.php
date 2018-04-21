<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $topics = Topic::withOrder($request->order)->paginate();
        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

        return redirect()->route('topics.show', $topic->id)->with('message', '创建成功.');
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        $categories = Category::all();

        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    /**
     * @param TopicRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());

        return redirect()->route('topics.show', $topic->id)->with('message', '更新成功.');
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);
        $topic->delete();

        return redirect()->route('topics.index')->with('message', '删除成功.');
    }

    /**
     * @param Request $request
     * @param ImageUploadHandler $uploader
     */
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        $data = [
            'success' => false,
            'msg' => '上传失败!',
            'file_path' => ''
        ];

        if ($file = $request->upload_file) {
            //保存图片到本地
            $result = $uploader->save($file, 'topics', \Auth::id(), 1024);
            //图片保存成功的话
            if ($result) {
                $data['success'] = true;
                $data['msg'] = '上传成功';
                $data['file_path'] = $result['path'];
            }
        }
        return $data;
    }
}
