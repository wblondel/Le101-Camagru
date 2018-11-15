<?php declare(strict_types=1);

namespace App\Controller;

use Core\Controller\Controller;
use Core\String\Lorem;
use Core\String\Str;

/**
 * Class DebugController
 * @package App\Controller
 */
class ImagesController extends AppController
{
    protected $template = 'gallery';

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Image');
        $this->loadModel('Tag');
    }

    public function index()
    {
        $logged = $this->logged;

        //$images = $this->Image->lastWithTags();
        $images = $this->Image->last();

        $customjs = ["/js/progressive-image.js"];
        $customcss = ["/css/gallery.css", "/css/progressive-image.css"];
        $this->render('images.index', compact( 'customjs', 'customcss', 'logged', 'images'));
    }

    public function new()
    {
        $logged = $this->logged;
        $this->template = 'default';
        $customjs = ["/js/camera.js"];
        $customcss = ["/css/camera.css"];
        $page_title = _("Share a picture");
        $this->render('images.new', compact('page_title', 'customjs', 'customcss', 'logged'));
    }

    public function tag(int $id)
    {
        $tag = $this->Tag->find($id);
        if ($tag === false) {
            $this->notFound();
        }
        $images = $this->Image->lastByTag($id);
        $tags = $this->Tag->all();

        $customjs = ["/js/progressive-image.js"];
        $customcss = ["/css/gallery.css", "/css/progressive-image.css"];
        $this->render('images.tag', compact('images', 'tags', 'tag', 'customjs', 'customcss'));
    }

    public function show(int $id)
    {
        $logged = $this->logged;

        $single_image = $this->Image->findWithUser($id);
        if ($single_image === false) {
            $this->notFound();
        }


        $customjs = ["/js/progressive-image.js"];
        $customcss = ["/css/gallery.css", "/css/progressive-image.css"];
        $this->render('images.show', compact('single_image', 'logged', 'customjs', 'customcss'));
    }
}