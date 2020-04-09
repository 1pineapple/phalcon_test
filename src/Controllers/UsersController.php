<?php
declare(strict_types=1);

namespace App\Controllers;


use App\Forms\UsersForm;
use App\Models\Users;
use Phalcon\Paginator\Adapter\Model;



class UsersController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Users list');
    }

    public function indexAction()
    {

    }

    public function listAction(string $type)
    {
        if ($type === 'table') {
            $numberPage = $this->request->getQuery('page', 'int', 1);
            $count = Users::find()->count();
            if ($numberPage !== 1 && $count / 5 / $numberPage <= 0.5) {
                $numberPage--;
            }
            $paginator = new Model([
                "model" => Users::class,
                'limit' => 5,
                'page' => $numberPage,
            ]);

            $viewParametrs = ['counts' => $count, 'page' => $paginator->paginate(),'roles'=>$this->session->get('auth')['roles']];
            return $this->response->setJsonContent($viewParametrs);
        }

    }

    public function newAction(): void
    {
        $this->view->form = new UsersForm();
    }

    public function createAction()
    {
        $form = new UsersForm();
        $user = new Users();
        $postData = $this->request->getPost();
        return $this->saveUser($user,$postData,$form,'User was created successes');
    }

    public function deleteAction()
    {
        $postData = $this->request->getPost();
        $user = Users::findFirstById($postData['id']);
        if ($this->session->get('auth')['id'] !== $user->id) {
            $user->delete();
        }
    }

    public function editAction(int $id)
    {
        $user = Users::findFirstById($id);
        if (!$user) {
            $this->flash->error('User was not found');

            $this->dispatcher->forward([
                'controller' => 'users',
                'action'     => 'index',
            ]);

            return;
        }
        $user->password = "";
        $this->view->roles = $user->roles;

        $this->view->form = new UsersForm($user, ['edit' => true]);
    }

    public function saveAction()
    {
        $form = new UsersForm();
        $postData = $this->request->getPost();
        $user = Users::findFirstById($postData['id']);
        if (!$user) {
            $error = [
                "error" => true,
                "db" => true,
                "message" => ["User was not found"]
            ];
            return $this->response->setJsonContent($error);
        }
        return $this->saveUser($user,$postData,$form,'User was updated successes');
    }

    private function saveUser($user,$postData,$form,$message)
    {
        if (!$form->isValid($postData)) {
            $error = [
                "error" => true,
                "db" => false,
                "message" => []
            ];
            foreach ($form->getMessages() as $message) {
                $error["message"][] = $message;
            }

            return $this->response->setJsonContent($error);
        }
        $user->login = $postData["login"];
        $user->password = sha1($postData["password"]);
        $user->roles = json_encode(array_keys($postData, "on"));
        if (!$user->save()) {
            $error = [
                "error" => true,
                "db" => true,
                "message" => []
            ];
            foreach ($user->getMessages() as $message) {
                $error["message"][] = (string) $message;
            }
            return $this->response->setJsonContent($error);
        }

        $form->clear();
        return $this->response->setJsonContent(["error" => false, "message" => $message]);
    }
}