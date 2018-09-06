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

use App\Series;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class SeriesController extends Controller
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
            ->header('课程系列')
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
            ->header('课程系列详情')
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
            ->header('编辑课程系列')
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
            ->header('创建课程系列')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Series());

        $grid->id('Id')->sortable();
        $grid->title('名称')->editable();
        $grid->introduction('简介')->limit(50);
        $grid->video_count('视频数')->label('info');
        $grid->archived('已完结')->switch();
        $grid->created_at('创建时间')->sortable();
        $grid->updated_at('更新时间')->sortable();

        $grid->disableExport();
        $grid->disableFilter();

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
        $show = new Show(Series::findOrFail($id));

        $show->id('Id');
        $show->title('Title');
        $show->introduction('Introduction');
        $show->thumb('Thumb');
        $show->archived('Archived');
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
        $form = new Form(new Series());

        $form->text('title', '标题');
        $form->textarea('introduction', '简介');
        $form->image('thumb', '封面图')->crop(720, 480)->move('images/series');
        $form->switch('archived', '已完结');

        return $form;
    }
}
