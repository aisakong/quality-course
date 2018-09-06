<?php

namespace App\Admin\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Topic;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class TopicsController extends Controller
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
            ->header('话题列表')
            ->body($this->grid());
    }

    // /**
    //  * Show interface.
    //  *
    //  * @param mixed   $id
    //  * @param Content $content
    //  * @return Content
    //  */
    // public function show($id, Content $content)
    // {
    //     return redirect()->route('topics.show', $id);
    // }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Topic);

        $grid->id('Id')->sortable();
        $grid->title('标题')->limit(50);
        $grid->user()->name('作者');
        $grid->category()->name('分类');
        $grid->reply_count('回复量')->label('info')->sortable();
        $grid->view_count('点击量')->label('info')->sortable();
        $grid->created_at('创建时间')->sortable();

        $grid->disableExport();

        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableView();

            $url = route('topics.show', $actions->getKey());
            $actions->prepend('<a href="'.$url.'" target="_blank"><i class="fa fa-eye"></i></a>');
        });

        $grid->filter(function ($filter) {
            $filter->like('title', '标题');

            $userIdOptions = [];
            foreach (User::all() as $user) {
                $userIdOptions[$user->id] = $user->name;
            }
            $filter->equal('user_id', '作者')->select($userIdOptions);

            $categoryIdOptions = [];
            foreach (Category::all() as $category) {
                $categoryIdOptions[$category->id] = $category->name;
            }
            $filter->equal('category_id', '分类')->select($categoryIdOptions);
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Topic);

        $form->text('title', 'Title');
        $form->textarea('body', 'Body');
        $form->number('user_id', 'User id');
        $form->number('category_id', 'Category id');
        $form->number('reply_count', 'Reply count');
        $form->number('view_count', 'View count');
        $form->number('last_reply_user_id', 'Last reply user id');
        $form->number('order', 'Order');
        $form->textarea('excerpt', 'Excerpt');
        $form->text('slug', 'Slug');

        return $form;
    }
}
