<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class SlackNotify
{
    private $client;

    private $channel = 'tpslalom';

    private $username = '黑蝙蝠';

    private $msg = 'Hello World';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function notify()
    {
        $url = 'https://hooks.slack.com/services/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';

        $array = [
            'channel'  => $this->getChannel(),
            'username' => $this->getUsername(),
            'text'     => $this->getMsg()
        ];

        $this->client->post($url, [
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
