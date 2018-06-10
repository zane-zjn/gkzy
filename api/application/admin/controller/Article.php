<?php
/**
 * Created by PhpStorm.
 * User: Ning
 * Date: 2018/5/1
 * Time: 21:58
 */

namespace app\admin\controller;


use think\Loader;
use think\Request;

class Article extends Base
{
    public function index()
    {
        return $this->success(\app\admin\model\Article::getAll());
    }

    public function save(Request $request)
    {
        $atitle = $request->param('atitle');
        $acontent = $request->param('acontent');
        $author = $request->param('author');
        $validate = Loader::validate('Article');
        if (!$validate->check(['atitle' => $atitle, 'acontent' => $acontent, 'author' => $author])) {
            return $this->error($validate->getError());
        }
        $article = new \app\admin\model\Article([
            'atitle' => $atitle, 'acontent' => $acontent, 'author' => $author
        ]);
        $article->save();
        return $this->success($article);
    }

    public function delete(Request $request)
    {
        $aid = $request->param('id');
        $article = \app\admin\model\Article::searchById($aid);
        $article->delete();
        return $this->success($article);
    }

    public function update(Request $request)
    {
        $aid = $request->param('aid');
        $article = \app\admin\model\Article::searchById($aid);
        $article->atitle = $request->param('atitle');
        $article->acontent = $request->param('acontent');
        $article->author = $request->param('author');
        $article->save();
        return $this->success($article);
    }
}