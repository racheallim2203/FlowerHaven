<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/*
 * This file is loaded in the context of the `Application` class.
  * So you can use  `$this` to reference the application class instance
  * if required.
 */
return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);
    $routes->setExtensions(['json']); // Allow JSON extension for routes

// Add route for processOrder action
    $routes->connect('/orderdeliveries/processorder', [
        'controller' => 'OrderDeliveries',
        'action' => 'processOrder',
    ])->setMethods(['POST']); // Restrict to POST method

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/about', ['controller' => 'Pages', 'action' => 'aboutus']);
        $builder->connect('/admin', ['controller' => 'Flowers', 'action' => 'index']);
        $builder->connect('/our-flowers', ['controller' => 'Flowers', 'action' => 'customerIndex']);
        $builder->connect('/contact', ['controller' => 'Pages', 'action' => 'contact']);
        $builder->connect('/flowers/add-to-cart', ['controller' => 'Flowers', 'action' => 'addToCart']);
        $builder->connect('/flowers/shopping-cart', ['controller' => 'Flowers', 'action' => 'customerShoppingCart']);
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
        $builder->connect('/order-deliveries', ['controller' => 'OrderDeliveries', 'action' => 'index']);
        $builder->connect('/aboutus', ['controller' => 'Pages', 'action' => 'aboutus']);
        $builder->connect('/customerpayments', ['controller' => 'Payments', 'action' => 'index']);
        $builder->connect('/payments', ['controller' => 'Payments', 'action' => 'admin_index']);
        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */


        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display']);

        $builder->redirect('/content-blocks/flowers', ['controller' => 'Flowers', 'action' => 'index']);
        $builder->redirect('/content-blocks/payments/admin-index', ['controller' => 'Payments', 'action' => 'adminIndex']);
        $builder->redirect('/content-blocks/users', ['controller' => 'Users', 'action' => 'index']);
        $builder->redirect('/content-blocks/categories', ['controller' => 'Categories', 'action' => 'index']);
        $builder->redirect('/content-blocks/order-deliveries', ['controller' => 'OrderDeliveries', 'action' => 'index']);
        $builder->redirect('/content-blocks/admin', ['controller' => 'Flowers', 'action' => 'index']);
        $builder->redirect('/content-blocks/pages/display', ['controller' => 'Pages', 'action' => 'display']);
        $builder->redirect('/content-blocks/auth/logout', ['controller' => 'Auth', 'action' => 'logout']);



        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder): void {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
