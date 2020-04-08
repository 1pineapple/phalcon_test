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

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Welcome');
    }

    public function indexAction(): void
    {
        $user = Users::findFirst();
        var_dump($user);
        $this->flash->notice(
            'This is a sample application of the Phalcon Framework.
                Please don\'t provide us any personal information. Thanks'
        );
    }
}
