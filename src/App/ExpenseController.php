<?php

namespace Src\App;

use Src\App\Expense;
use Src\Core\Request;
use Src\Core\Container;

class ExpenseController 
{
    public function __construct()
    {
        $this->response = Container::get('response');
        $this->expenseRepo = Container::get('expenseRepo');
    }

    public function all() {
        return $this->response->sendMessage($this->expenseRepo->all());
    }

    public function getBy($id) {
        if (!$this->expenseRepo->find($id)) {
            $this->response->sendError('Expense does not exist', 404);
        }
        $this->response->sendMessage($this->expenseRepo->find($id));
    }

    public function store() {
        $json = Request::getContent();
        $expense = Expense::fromArray(json_decode($json, true));
        if (empty($expense->subject)) {
            $this->response->sendError('Subject is mandatory', 400);
        }
        $this->expenseRepo->add($expense);
        $this->response->status(201);
        $this->response->sendMessage($this->expenseRepo->all());
    }

    public function update($id) {
        if (!$this->expenseRepo->find($id)) {
            $this->response->sendError('Expense does not exist', 404);
        }
        $json = Request::getContent();
        $expense = Expense::fromArray(json_decode($json, true));

        $result = $this->expenseRepo->update($id, $expense);

        if ($result) {
            $this->response->sendMessage($result);
        }
        $this->response->sendError('Expense not found', 418);
    }

    public function remove($id) {
        if (!$this->expenseRepo->find($id)) {
            $this->response->sendError('Expense does not exist', 404);
        }
        $result = $this->expenseRepo->remove($id);
        if ($result) {
            $this->response->sendEmpty(204);
        }
    }
}