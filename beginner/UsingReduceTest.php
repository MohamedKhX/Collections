<?php

class UsingReduceTest extends \PHPUnit\Framework\TestCase
{
    private function reduce($items, $callback, $initial)
    {
        return collect($items)->reduce(function ($sum, $number) use($callback) {
            return $callback($sum, $number);
        }, $initial);
    }

    public function test_calculate_the_product_of_a_list_of_numbers()
    {
        $numbers = [1, 2, 3, 4, 5, 6];

        /*
         * Add your solution here! Remember, no loops allowed!
         *
         * $product = $this->reduce($numbers, ...)
         */

        $product = $this->reduce($numbers, function ($sum, $number) {
           return  $sum * $number;
        }, 1);


        $this->assertEquals(720, $product);
    }

    public function test_create_an_associative_array_of_names_and_emails()
    {
        $users = [
            ['name' => 'John', 'email' => 'john@example.com'],
            ['name' => 'Jane', 'email' => 'jane@example.com'],
            ['name' => 'Dana', 'email' => 'dana@example.com'],
        ];

        /*
         * Add your solution here! Remember, no loops allowed!
         *
         * $emailLookup = $this->reduce($users, ...)
         */

        $emailLookup = $this->reduce($users, function ($array, $user) {
            $array[$user['name']] = $user['email'];
            return $array;
        }, []);

        $this->assertEquals([
            'John' => 'john@example.com',
            'Jane' => 'jane@example.com',
            'Dana' => 'dana@example.com',
        ], $emailLookup);
    }

    public function test_count_employees_in_each_department()
    {
        $employees = [
            ['name' => 'John', 'department' => 'Sales'],
            ['name' => 'Jane', 'department' => 'Marketing'],
            ['name' => 'Dave', 'department' => 'Marketing'],
            ['name' => 'Dana', 'department' => 'Engineering'],
            ['name' => 'Beth', 'department' => 'Marketing'],
            ['name' => 'Kyle', 'department' => 'Engineering'],
        ];

        /*
         * Add your solution here! Remember, no loops allowed!
         *
         * $departmentCounts = $this->reduce($employees, ...)
         */

        $departmentCounts = $this->reduce($employees, function ($array, $employee) {
            if (!isset($array[$employee['department']])) {
                $array[$employee['department']] = 0;
            }
            $array[$employee['department']]++;
            return $array;
        }, []);


        $this->assertEquals([
            'Sales' => 1,
            'Marketing' => 3,
            'Engineering' => 2,
        ], $departmentCounts);
    }
}
