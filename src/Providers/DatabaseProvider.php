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

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
class DatabaseProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $dbConfig = $di->getShared('config')->get('database')->toArray();
        $di->setShared('db', function () use ($dbConfig) {

            $class = 'Phalcon\Db\Adapter\Pdo\\' . $dbConfig['adapter'];
            $params = [
                'host'     => $dbConfig['host'],
                'username' => $dbConfig['username'],
                'password' => $dbConfig['password'],
                'dbname'   => $dbConfig['dbname'],
                'charset'  => $dbConfig['charset']
            ];

            if ($dbConfig['adapter'] == 'Postgresql') {
                unset($params['charset']);
            }

            return new $class($params);
        });
    }
}
