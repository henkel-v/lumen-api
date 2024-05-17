<?php

namespace Tests;

use App\Models\Loan;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LoanTest extends TestCase
{
//    use DatabaseMigrations;

    public function testCreateLoan()
    {
        $data = [
            'borrower_name' => 'John Doe',
            'amount' => 1000.00,
            'loan_date' => '2023-05-01',
        ];

        $this->post('/loans', $data)
            ->seeStatusCode(201)
            ->seeJson($data);
    }

    public function testGetLoan()
    {
        $loan = Loan::factory()->create();

        $this->get("/loans/{$loan->id}")
            ->seeStatusCode(200)
            ->seeJson($loan->toArray());
    }

    public function testUpdateLoan()
    {
        $loan = Loan::factory()->create();
        $updateData = ['amount' => 2000.00];

        $this->put("/loans/{$loan->id}", $updateData)
            ->seeStatusCode(200)
            ->seeJson($updateData);
    }

    public function testDeleteLoan()
    {
        $loan = Loan::factory()->create();

        $this->delete("/loans/{$loan->id}")
            ->seeStatusCode(200)
            ->seeJson(['message' => 'Loan deleted']);
    }

    public function testListLoans()
    {
        Loan::factory()->count(5)->create();

        $this->get('/loans')
            ->seeStatusCode(200)
            ->seeJsonStructure([['id', 'borrower_name', 'amount', 'loan_date']]);
    }
}
