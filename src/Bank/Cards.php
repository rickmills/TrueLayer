<?php

namespace TrueLayer\Bank;

use TrueLayer\Data\Card;
use TrueLayer\Exceptions\OauthTokenInvalid;
use TrueLayer\Request;

class Cards extends Request
{
    /**
     * Get all accounts
     *
     * @return Card[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws OauthTokenInvalid
     */
    public function get()
    {
        $result = $this->connection
            ->setAccessToken($this->token->getAccessToken())
            ->get("/data/v1/cards");

        $this->statusCheck($result);
        $accounts = json_decode($result->getBody(), true);

        $cards = [];

        foreach ($accounts['results'] as $key => $result) {
            $cards[$key] = new Card($result);
        }

        return $cards;
    }
}
