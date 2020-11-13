<?php

require __DIR__ . '/../vendor/autoload.php';

use Src\App\Expense;
use Src\Core\Router;
use Src\Core\Response;
use Src\Core\Container;
use Src\App\ExpenseRepo;
use Src\App\ExpenseController;
use Src\Core\ExceptionHandler;


$response = new Response;
new ExceptionHandler($response);

$expenseRepo = new ExpenseRepo;

$expenseRepo->add(new Expense("Fortunata y Jacinta", 15.20));
$expenseRepo->add(new Expense('Buy Me a Coffe', 3.00));
$expenseRepo->add(new Expense('Jamón Pata Negra 5J', 350.00));

Container::add('response', $response);
Container::add('expenseRepo', $expenseRepo);

$router = new Router;

/*
GET /expenses
GET /expenses/{id}
POST /expenses
PUT /expenses/{id}
DELETE /expenses/{id}
*/

$router->get(
    '/expenses',
    [ExpenseController::class, 'all']
);

$router->get(
    '/expenses/([0-9]+)',
    [ExpenseController::class, 'getBy']
);

$router->post(
    '/expenses',
    [ExpenseController::class, 'store']
);

$router->put(
    '/expenses/([0-9]+)',
    [ExpenseController::class, 'update']
);

$router->delete(
    '/expenses/([0-9]+)',
    [ExpenseController::class, 'remove']
);

$router->run();
