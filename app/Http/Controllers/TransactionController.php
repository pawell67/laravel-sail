<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\TransactionService;
use App\Exceptions\TransactionException;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public function __construct(private TransactionService $transactionService)
    {
        parent::__construct();
    }

    public function getTransactions(): Response
    {
        try {
            $transactions = $this->transactionService
                ->getTransactions($this->request->getQueryParams()['source'] ?? '');
            return (new Response())
                ->setContent($transactions)
                ->setStatusCode(Response::HTTP_OK);
        } catch (TransactionException $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
