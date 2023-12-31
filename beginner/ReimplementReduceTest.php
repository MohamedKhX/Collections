<?php

class ReimplementReduceTest extends \PHPUnit\Framework\TestCase
{
    private function reduce($items, $callback, $initial)
    {
        return collect($items)->reduce(function ($sum, $number) use($callback) {
            return $callback($sum, $number);
        }, $initial);
    }

    public function test_add_numbers()
    {
        $sum = $this->reduce([1, 2, 3, 4, 5, 6], function ($sum, $number) {
            return $sum + $number;
        }, 0);

        $this->assertEquals(21, $sum);
    }

    public function test_join_emails()
    {
        $emails = [
            'john@example.com',
            'jane@example.com',
            'dana@example.com',
        ];

        $joined = $this->reduce($emails, function ($joined, $email) {
            return $joined . $email . ',';
        }, '');

        $this->assertEquals("john@example.com,jane@example.com,dana@example.com,", $joined);
    }

    public function test_join_grocery_list_lines()
    {
        $groceries = [
            'Bananas',
            'Milk',
            'Cream',
            'Sugar',
            'Apples',
            'Bread',
            'Coffee',
        ];

        $groceryList = $this->reduce($groceries, function ($groceryList, $groceryItem) {
            return $groceryList . $groceryItem . "\n";
        }, '');

        $this->assertEquals("Bananas\nMilk\nCream\nSugar\nApples\nBread\nCoffee\n", $groceryList);
    }
}
