<?php

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;

class PostsController extends AppController
{
    public function __construct() {
        parent::__construct();
        $this->loadModel('Post');
    }

    public function index() {
        $posts = $this->Post->all();
        $this->render('admin.posts.index', compact('posts'));
    }

    public function add(){
        if(!empty($_POST)) {
            $result = $this->Post->create([
                'title' => $_POST['title'],
                'text' => $_POST['text'],
                'category_id' => $_POST['category_id']
            ]);
            if ($result) {
                $this->redirect('posts', 'index', 'admin');
            }
        }
        $this->loadModel('Category');
        $categories = $this->Category->list('id', 'name');
        $form = new BootstrapForm($_POST);
        $this->render('admin.posts.edit', compact('categories', 'form'));
    }

    public function edit(){
        if(!empty($_POST)) {
            $result = $this->Post->update($_GET['id'], [
                'title' => $_POST['title'],
                'text' => $_POST['text'],
                'category_id' => $_POST['category_id']
            ]);
            if ($result) {
                $this->redirect('posts', 'index', 'admin');
            }
        }
        $post = $this->Post->find($_GET['id']);
        $this->loadModel('Category');
        $categories = $this->Category->list('id', 'name');
        $form = new BootstrapForm($post);
        $this->render('admin.posts.edit', compact('categories', 'form'));
    }

    public function delete(){
        if(!empty($_POST)) {
            $result = $this->Post->delete($_POST['id']);
            $this->redirect('posts', 'index', 'admin');
        }
    }
}