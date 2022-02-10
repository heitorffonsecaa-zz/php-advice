<?php


namespace App;

use ErrorException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Stichoza\GoogleTranslate\GoogleTranslate;
use GuzzleHttp\Client;

class Advice
{
    private const BASE_API = "https://api.adviceslip.com";
    private int $id;
    private string $word;
    private GoogleTranslate $googleTranslate;

    public function __construct()
    {
        $this->googleTranslate = new GoogleTranslate('pt');
    }

    /**
     * get random advice
     *
     * @return Advice
     * @throws GuzzleException
     * @throws Exception
     */
    public function getRandom(): Advice
    {
        $client = new Client();
        $res = $client->get(self::BASE_API . "/advice");

        if ($res->getStatusCode() != 200)
            throw new Exception("Request failed", 500);

        $slip = json_decode($res->getBody())->slip;

        $this->id = (int)$slip->id;
        $this->word = (string)$slip->advice;

        return $this;
    }

    /**
     * @throws ErrorException
     */
    public function translate(): ?string
    {
        return $this->googleTranslate->translate($this->word);
    }
}