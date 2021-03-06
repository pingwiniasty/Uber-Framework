<?php

namespace app\Http\Controller;

use app\Model\EntriesModel;
use uber\Utils\DataManagement\VariablesManagement;

/**
 * Entries controller, managing all processes of
 * entries system.
 *
 * Class EntriesController
 *
 * @category Controller
 *
 * @package app\Http\Controller
 *
 * @author Original Author <kamil.ubermade@gmail.com>
 *
 * @license The MIT License (MIT)
 *
 * @link https://github.com/kamil-ubermade/Uber-Framework
 */
class EntriesController extends \uber\Http\MainController
{
    /**
     * @var VariablesManagement
     */
    private $variables;

    /**
     * EntriesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->variables = new VariablesManagement();
    }

    public function displayAction()
    {
        $em = $this->getEntityManager();

        $model = $em->getRepository('app\Model\EntriesModel')->findAll();

        $this->render('Entries/displayAction.html.twig', [
            'entries' => $model
        ]);
    }

    public function addAction()
    {
        if ($this->variables->isPostExists('title') && $this->variables->isPostExists('content')) {
            $em = $this->getEntityManager();
            $model = new EntriesModel();

            $model->setTitle($this->variables->post('title'));
            $model->setContent($this->variables->post('content'));

            $em->persist($model);
            $em->flush();

            $this->redirect('displayEntries');
        } else {
            $this->render('Entries/addAction.html.twig');
        }
    }

    public function removeAction()
    {
        if ($this->variables->isGetExists('id') && $this->variables->get('id') !== 0) {
            $em = $this->getEntityManager();

            $model = $em->find('app\Model\EntriesModel', $this->variables->get('id'));
            if ($model) {
                $em->remove($model);
                $em->flush();
            }
        }

        $this->redirect('displayEntries');
    }
}