<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;  // Make sure to use the correct namespace

class PagesController extends AppController
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        // Allow unauthenticated access to 'view' and 'index' actions in PagesController
        $this->Authentication->allowUnauthenticated(['display', 'aboutus', 'faq', 'contact']);
    }

    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        $this->viewBuilder()->setLayout('default2');
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function aboutus()
    {
        $this->viewBuilder()->setLayout('default2');
        $this->set('title', 'About Us - Flower Haven');
        // Ensure the view file 'aboutus.php' is being used
        return $this->render();
    }
    public function faq()
    {
        $this->viewBuilder()->setLayout('default2');
        $this->set('title', 'FAQ');
        // Ensure the view file 'aboutus.php' is being used
        return $this->render();
    }
    public function contact()
    {
        $this->viewBuilder()->setLayout('default2');
        $this->set('title', 'Contact Us');
        // Ensure the view file 'aboutus.php' is being used
        return $this->render();
    }


}
