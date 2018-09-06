<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Reply;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class RepliesController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('话题回复')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reply());

        $grid->id('Id')->sortable();
        $grid->topic_id('话题ID')->sortable();
        $grid->user_id('用户ID')->sortable();
        $grid->content('内容');
        $grid->created_at('创建时间')->sortable();

        $grid->disableExport();

        $grid->actions(function ($actions) {
            $actions->disableEdit();
            $actions->disableView();

            $reply = $actions->row;
            $url = route('topics.show', $reply['topic_id']).'#reply'.$reply['id'];
            $actions->prepend('<a href="'.$url.'" target="_blank"><i class="fa fa-eye"></i></a>');
        });

        $grid->filter(function ($filter) {
            $filter->like('content', '内容');
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
        $form = new Form(new Reply());

        $form->number('topic_id', 'Topic id');
        $form->number('user_id', 'User id');
        $form->textarea('content', 'Content');

        return $form;
    }
}
