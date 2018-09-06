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
use App\Series;
use App\Video;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class VideosController extends Controller
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
            ->header('视频列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('视频详情')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑视频')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('添加视频')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Video());

        $grid->id('Id')->sortable();
        $grid->order('排序')->editable()->sortable();
        $grid->title('标题');
        $grid->series()->title('系列');
        $grid->view_count('播放量')->sortable();
        $grid->length('时间')->display(function ($length) {
            return date('i:s', $length);
        });
        $grid->created_at('创建时间')->sortable();
        $grid->updated_at('更新时间')->sortable();

        $grid->disableExport();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Video::findOrFail($id));

        $show->id('Id');
        $show->title('Title');
        $show->series_id('Series id');
        $show->view_count('View count');
        $show->body('Body');
        $show->order('Order');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Video());

        $form->text('title', '标题');

        $seriesIdOptions = [];
        foreach (Series::all() as $series) {
            $seriesIdOptions[$series->id] = $series->title;
        }
        $form->select('series_id', '系列')->options($seriesIdOptions);

        $form->file('src', '视频')
            ->options(['showPreview' => false])
            ->move('videos')
            // ->rules('mimetypes:video/mp4,video/x-flv')
            ->name(function ($file) {
                return md5(uniqid()).'.'.$file->guessExtension();
            });

        $form->editor('body', '内容');
        $form->hidden('view_count', '播放量')->value(0);
        $form->hidden('order', '排序')->value(0);

        return $form;
    }
}
