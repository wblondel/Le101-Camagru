<?php declare(strict_types=1);

namespace App\Controller;

use Core\Controller\Controller;
use Core\String\Lorem;

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
    }

    public function index()
    {
        $logged = $this->logged;

        $pics = [];

        // creation d'une liste random d'images
        for ($x = 0; $x <= 30; $x++) {
            $pics[] = [
                "url" => "https://picsum.photos/348/225?random=" . $x,
                "alt" => "Small desc",
                "desc" =>  /*substr(*/Lorem::ipsum(1, 1, 6)/*, 0, 100) . '...'*/
            ];
        }

        $customjs = ["js/progressive-image.js"];
        $customcss = ["css/gallery.css", "css/progressive-image.css"];
        $this->render('images.index', compact('customjs', 'customcss', 'logged', 'pics'));
    }

    public function new()
    {
        $logged = $this->logged;
        $this->template = 'default';
        $customjs = ["js/camera.js"];
        $customcss = ["css/camera.css"];
        $this->render('images.new', compact('customjs', 'customcss', 'logged'));
    }

    public function show()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $image = $this->Image->find($_GET['id']);
            if ($image === false) {
                $this->notFound();
            }
            $this->render('images.show', compact('image'));
        } else {
            $this->badRequest();
        }

    }
}