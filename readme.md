# Quality Course


## 项目概述

![GitHub](https://img.shields.io/github/license/mashape/apistatus.svg)

- 产品名称：Quality Course
- License：MIT

Quality Course 是一个适用于视频教学的播客网站应用，始用于『精品课程』。

## 功能如下

- 门户首页 —— 显示最新的课程、话题；
- 用户认证 —— 注册、登录、退出；
- 个人中心 —— 用户个人中心，编辑资料；
- 课程系列 —— 显示所有课程系列；
- 课程详情 —— 课程介绍、难度、时长、提纲、更新状态；
- 话题模块 —— 基本的社区话题讨论功能；
- 支持 Markdown —— 使用 Markdown 作为文本格式；
- 多角色权限管理 —— 允许教师，助教权限的存在；
- 话题发布时自动 Slug 翻译，支持使用队列方式以提高响应；
- 站点『活跃用户』计算，一小时计算一次；
- 记录用户的最后登录时间；
- XSS 安全防御；

## 环境要求

- Nginx 1.8+
- PHP 7.1+
- Mysql 5.7+
- Redis 3.0+
- FFmpeg 2.8+

## 安装方法

本项目使用 [Laravel 5.5](https://laravel-china.org/docs/laravel/5.5/) 框架开发，推荐使用以下基础环境：

- 本地开发环境：[Laravel Homestead](https://d.laravel-china.org/docs/5.5/homestead)
- 线上部署环境：[laravel-ubuntu-init](https://github.com/summerblue/laravel-ubuntu-init)

### 本地部署

用于本地测试、开发。

1. 克隆源代码

   ```shell
   > git clone git@github.com:summerblue/larabbs.git
   ```

2. 配置 Homestead 参数

   1. 运行以下命令编辑 Homestead.yaml 文件：

       ```shell
       > vim Homestead.yaml
       ```

   2. 加入对应修改，如下所示：

      ```yaml
      folders:
          - map: ~/my-path/tips/ # 你本地的项目目录地址
            to: /home/vagrant/tips
      
      sites:
          - map: tips.test
            to: /home/vagrant/larabbs/public
      
      databases:
          - tips
      ```

   3. 应用修改

       ```shell
       > vagrant provision && vagrant reload
       ```

3. 安装扩展包依赖

   ```shell
   $ composer install
   ```

4. 生成配置文件

   ```shell
   $ cp .env.example .env
   ```

   同时应根据实际情况修改 `.env` 文件里的内容，如数据库连接、缓存、邮件设置等。

5. 生成密钥

   ```shell
   $ php artisan key:generate
   ```

6. 生成数据表及填充基本数据

   ```shell
   $ php artisan migrate --seed
   ```

7. 配置 hosts 文件

   ```tex
   192.168.10.10 tips.test
   ```

8. 前端依赖安装

   1. 安装前端依赖

      ```shell
      $ npm install
      ```

      也可以使用 Yarn 安装。

   2. 编译前端内容

      ```shell
      // 运行所有 Mix 任务...
      $ npm run dev
      
      // 运行所有 Mix 任务并缩小输出..
      $ npm run production
      ```

   3. 监控修改并自动编译

      ```shell
      $ npm run watch
      ```

      在某些环境中，当文件更改时，Webpack 不会更新。如果系统出现这种情况，请考虑使用 watch-poll 命令：

      ```shell
      $ npm run watch-poll
      ```

### 线上部署

使用 [laravel-ubuntu-init](https://github.com/summerblue/laravel-ubuntu-init) 快速配置新站点，其余操作与本地部署类似。

### 链接入口

- 首页地址：<http://tips.test/>
- 管理后台：<http://tips.test/admin>

管理员账号密码如下:

```tex
username: admin
password: admin
```

## 扩展使用情况

| 扩展包                                                       | 描述                       | 应用场景                       |
| ------------------------------------------------------------ | -------------------------- | ------------------------------ |
| [Intervention/image](https://github.com/Intervention/image)  | 图片处理功能库             | 用于图片裁切                   |
| [guzzlehttp/guzzle](https://github.com/guzzle/guzzle)        | HTTP 请求套件              | 请求百度翻译 API               |
| [predis/predis](https://github.com/nrk/predis.git)           | Redis 操作库               | 缓存驱动 Redis 基础扩展包      |
| [spatie/laravel-permission](https://github.com/spatie/laravel-permission) | 角色权限管理               | 角色和权限控制                 |
| [mewebstudio/Purifier](https://github.com/mewebstudio/Purifier) | 用户提交的 Html 白名单过滤 | 安全过滤，防止 XSS 攻击        |
| [hieu-le/active](https://github.com/letrunghieu/active)      | 选中状态                   | 顶部导航栏选中状态             |
| [laravel-admin](http://laravel-admin.org/)                   | 管理后台                   | 模型管理后台、配置信息管理后台 |
| [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) | 页面调试工具栏             | 开发环境中的 DEBUG             |
| [viacreative/sudo-su](https://github.com/viacreative/sudo-su) | 用户切换                   | 开发环境中快速切换登录账号     |

## Artisan 命令

| 命令                       | 说明                                | 周期              | 代码调用 |
| -------------------------- | ----------------------------------- | ----------------- | -------- |
| tips:calculate-active-user | 生成活跃用户                        | 一小时运行一次    | 无       |
| tips:sync-user-actived-at  | 从 Redis 中同步最后登录时间到数据库 | 每天早上 0 点准时 | 无       |

## 队列清单

| 名称              | 说明                  | 调用时机                   |
| ----------------- | --------------------- | -------------------------- |
| TranslateSlug.php | 将话题标题翻译为 Slug | TopicObserver 事件 saved() |
| TopicReplied.php  | 通知作者话题有新回复  | 话题被评论以后             |

## TODO

- 话题点赞
- 课程学习次数统计
- 课程文档协同编写











