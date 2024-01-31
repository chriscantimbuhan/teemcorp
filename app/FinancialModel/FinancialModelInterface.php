<?php

namespace App\FinancialModel;

interface FinancialModelInterface
{
    public function searchType();

    public function apiUrl();

    public function key();

    public function value();

    public function execute();
}
