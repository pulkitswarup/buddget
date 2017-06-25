<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoreExpensesTest extends TestCase
{
    /** @test */
    public function user_can_store_expense_details()
    {
        $users = factory(User::class)->create([
            "name" => "Slade Wilson",
            "email"=> "slade.wilson@example.com"
        ]);

        $this->post("/users/". $users->id."/expenses", [
            "label"=> "Some Stuff",
            "amount"=> "1234",
            "currency"=> "Euro",
            "category_label" => "Stuff Category"
        ]);

        $this->assertStatus(201);
    }
}