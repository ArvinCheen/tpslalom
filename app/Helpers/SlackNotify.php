<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class SlackNotify
{
    private $client;

    private $channel = 'tpslalom';

    private $username = '黑蝙蝠';

    private $msg = 'Hello World';

    private $url = 'https://hooks.slack.com/services/';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function notify()
    {
        $array = [
            'channel'  => $this->getChannel(),
            'username' => $this->getUsername(),
            'text'     => $this->getMsg()
        ];

        $this->client->post($this->url . env('SLACK', 'TH74P8D8E/BNYRD95TL/PSsMj6vuugwhsabb5zLX57X3'), [
            'form_params' => [
                'payload' => json_encode($array)
            ]
        ]);
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        if (env('ENV') == 'dev') {
            $this->msg = '`開發環境，這是假的` ' . $this->msg;
        }

        return $this->msg;
    }

    /**
     * @param mixed $channel
     * @return SlackNotify
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @param mixed $username
     * @return SlackNotify
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param mixed $msg
     * @return SlackNotify
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }
}
