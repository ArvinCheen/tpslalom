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
//        if (env('APP_ENV') == 'local') {
//            $url = 'https://hooks.slack.com/services/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';
//        } else {
//            $url = 'https://hooks.slack.com/services/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';
//        }

        $url = 'https://hooks.slack.com/services/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'; //TEST
//        $url = 'https://hooks.slack.com/services/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';
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
