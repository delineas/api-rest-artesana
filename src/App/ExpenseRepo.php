<?php

namespace Src\App;

class ExpenseRepo {

    private $expenses = [];

    public function add(Expense $expense) {
        $this->expenses[count($this->expenses)+1] = $expense;
    }

    public function all() {
        return $this->expenses;
    }

    public function update($id, Expense $expense) {
        if($this->find($id)) {
            $this->expenses[$id] = $expense;
            return $this->expenses[$id];
        }
        return false;
    }

    public function remove($id) {
        if ($this->find($id)) {
            unset($this->expenses[$id]);
            return true;
        }
        return false;
    }


    public function find($id) {
        if(!isset($this->expenses[$id])) {
            return false;
        }
        return $this->expenses[$id];
    }

}