<?php

namespace App\Controller;

use Core\Controller\Controller;

class PostsController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
    }

    public function index()
    {
        $posts = $this->Post->last();
        $categories = $this->Category->all();
        $this->render('posts.index', compact('posts', 'categories'));
    }

    public function category()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $category = $this->Category->find($_GET['id']);
            if ($category === false) {
                $this->notFound();
            }
            $articles = $this->Post->lastByCategory($_GET['id']);
            $categories = $this->Category->all();
            $this->render('posts.category', compact('articles', 'categories', 'category'));
        } else {
            $this->badRequest();
        }
    }

    public function show()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $post = $this->Post->findWithCategory($_GET['id']);
            if ($post === false) {
                $this->notFound();
            }
            $this->render('posts.show', compact('post'));
        } else {
            $this->badRequest();
        }
    }
}