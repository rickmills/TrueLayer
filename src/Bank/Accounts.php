<?php

namespace TrueLayer\Bank;

use TrueLayer\Data\Account;
use TrueLayer\Exceptions\OauthTokenInvalid;
use TrueLayer\Request;

class Accounts extends Request
{
    /**
     * Get all accounts
     *
     * @return Account|array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws OauthTokenInvalid
     */
    public function getAllAccounts()
    {
        $result = $this->connection
            ->setAccessToken($this->token->getAccessToken())
            ->get("/data/v1/accounts");

        $this->statusCheck($result);
        $accounts = json_decode($result->getBody(), true);

        array_walk($accounts['results'], function ($value) {
            return new Account($value);
        });

        return $accounts['results'];
    }
}
