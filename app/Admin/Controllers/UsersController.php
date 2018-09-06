<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UsersController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('用户管理')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('详细信息')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑用户')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('添加用户')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->id('Id')->sortable();
        $grid->name('姓名')->sortable()->editable();
        $grid->student_id('学号')->sortable()->editable();
        $grid->email('邮箱')->editable();
        $grid->created_at('注册时间')->sortable()->editable('datetime');

        $grid->college('学院')->sortable()->editable();
        $grid->major('专业')->sortable()->editable();
        $grid->class('班级')->sortable()->editable();
        $grid->validated('正方验证')->switch()->sortable();

        $grid->disableExport();

        $grid->filter(function ($filter) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            $filter->like('name', '姓名');
            $filter->like('student_id', '学号');
            $filter->like('college', '学院');
            $filter->like('major', '专业');
            $filter->like('class', '班级');

        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->name('用户名');
        $show->email('邮箱');
        $show->password('密码');
        $show->remember_token('Remember token');
        $show->created_at('创建时间');
        $show->updated_at('更新时间');
        $show->avatar('头像');
        $show->introduction('个人简介');
        $show->notification_count('未读消息');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('name', '用户名')->rules('required|min:2');
        $form->email('email', '邮箱')->rules('email');
        $form->password('password', '密码')->rules('required');
        $form->text('college', '学院');
        $form->text('major', '专业');
        $form->text('class', '班级');
        $form->image('avatar', '头像');
        $form->textarea('introduction', '个人简介');
        $form->switch('validated', '正方验证');

        $form->saving(function (Form $form) {
            $form->password = bcrypt($form->password);
        });

        return $form;
    }
}
