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
    }

    public function index()
    {
        $logged = $this->logged;

        $pics = [];

        // creation d'une liste random d'images
        for ($x = 0; $x <= 67; $x++) {
            $date = mt_rand(1518959057,1528959057);

            $pics[] = [
                /*"url" => "https://picsum.photos/348/225?random=" . $x,*/
                "url" => "img/gallery/225 - " . ($x + 1) . ".jpeg",
                "alt" => "Small desc",
                "desc" =>  /*substr(*/Lorem::ipsum(1, 1, 4)/*, 0, 100) . '...'*/,
                "created_at" => Str::time_elapsed_string('@' . $date),
                "created_at_nat" => date('d/m/Y', $date)
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