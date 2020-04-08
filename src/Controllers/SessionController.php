<?php
declare(strict_types=1);

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Controllers;

use App\Models\Users;

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Log In');
    }

    public function indexAction(): void
    {
        $this->tag->setDefault('login', 'demo');
        $this->tag->setDefault('password', 'phalcon');


    }

    /**
     * This action authenticate and logs an user into the application
     */
    public function startAction(): void
    {
        if ($this->request->isPost()) {
            $login = $this->request->getPost('login');
            $password = $this->request->getPost('password');

            /** @var Users $user */
            $user = Users::findFirst([
                "login = :login: AND password = :password:",
                'bind' => [
                    'login'    => $login,
                    'password' => sha1($password),
                ],
            ]);

            if ($user) {
                $this->registerSession($user);
                $this->flash->success('Welcome ' . $user->login);

                $this->dispatcher->forward([
                    'controller' => 'users',
                    'action'     => 'index',
                ]);

                return;
            }

            $this->flash->error('Wrong login/password');
        }

        $this->dispatcher->forward([
            'controller' => 'session',
            'action'     => 'index',
        ]);
    }

    /**
     * Finishes the active session redirecting to the index
     */
    public function endAction(): void
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');

        $this->dispatcher->forward([
            'controller' => 'index',
            'action'     => 'index',
        ]);
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function registerSession(Users $user): void
    {
        $this->session->set('auth', [
            'id'   => $user->id,
            'login' => $user->login,
            'roles' => $user->roles,
        ]);
    }
}
