<?php

namespace App\Http\Controllers;

use App\Category;
use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Topic;
use App\User;
use Auth;
use Illuminate\Http\Request;
use League\HTMLToMarkdown\HtmlConverter;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Topic $topic, User $user)
    {
        $topics = $topic->withOrder($request->order)->paginate(20);

        $active_users = $user->getActiveUsers();

        return view('topics.index', compact('topics', 'active_users'));
    }

    public function show(Request $request, Topic $topic)
    {
        // URL 矫正
        if (!empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        // 浏览次数 + 1
        \visits($topic)->seconds(30)->increment();

        // 该用户的其他话题
        $creator_topics = Topic::where([
            ['id', '!=', $topic->id],
            ['user_id', '=', $topic->user_id],
        ])->take(6)->get();

        return view('topics.show', compact('topic', 'creator_topics'));
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

        return redirect()->to($topic->link())->with('success', '成功创建话题！');
    }

    public function edit(HtmlConverter $converter, Topic $topic)
    {
        $this->authorize('update', $topic);

        $categories = Category::all();
        $topic->body = $converter->convert($topic->body);

        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());

        return redirect()->to($topic->link())->with('message', '成功更新话题！');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);
        $topic->delete();

        return redirect()->route('topics.index')->with('message', '成功删除话题！');
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success' => false,
            'msg' => '上传失败!',
            'filename' => '',
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['filename'] = $result['path'];
                $data['msg'] = "上传成功!";
                $data['success'] = true;
            }
        }

        return $data;
    }
}
