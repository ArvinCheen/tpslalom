<?php

namespace App\Services;

use GuzzleHttp\Client;

class SlackNotify
{
    private $client;

    private $channel = 'tpslalom';

    private $username = 'Bot';

    private $msg = 'Hello World';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function notify()
    {
        $uri = 'https://hooks.slack.com/services/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';

        $array = [
            'channel'  => $this->getChannel(),
            'username' => $this->getUsername(),
            'text'     => $this->getMsg()
        ];

        $this->client->post($uri, [
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
