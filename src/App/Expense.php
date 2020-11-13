<?php 

namespace Src\App;

class Expense {
    public $subject;
    public $amount;

    public function __construct($subject, $amount) {
        $this->subject = $subject;
        $this->amount = $amount;
    }

    public static function fromArray($attributes) {
        if (!isset($attributes['subject']) || !isset($attributes['amount'])) {
            throw new \Exception('Object can not created');
        }
        return new self($attributes['subject'], $attributes['amount']);
    }
}