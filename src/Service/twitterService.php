<?php

namespace App\Service;

use Simplon\Twitter\Twitter;

class twitterService
{
    public $twitter;
    public $stopRequests = false;
    public $maxId = null;
    public $statuses;
    public $requestCount = 0;

    public function __construct()
    {
        $this->twitter = new Twitter($_SERVER['API_KEY'], $_SERVER['API_SECRET']);
        $this->authorize();
    }

    protected function authorize()
    {
        $this->twitter->setOauthTokens($_SERVER['ACCESS_TOKEN'], $_SERVER['ACCESS_SECRET']);
    }

    public function crawlerCommand() {
        return count($this->getActualTweetsFromUsers());
    }

    protected function getActualTweetsFromUsers(): array
    {
        $users = ['nevercodealone'];

        foreach ($users as $user) {
            $getConfig = array(
                'user_id' => $user,
                'trim_user' => true,
                'exclude_replies' => true,
                'count' => 200
            );

            if(!empty($this->maxId)) {
                $getConfig['max_id'] = number_format($this->maxId, 0, '.', '');
            }

            $this->requestCount++;

            $rawStatuses = $this->twitter->get('statuses/user_timeline', $getConfig);

            foreach($rawStatuses as $rawStatus) {
                $this->maxId = $rawStatus['id'];
                $this->statuses[] = array(
                    'id' => $rawStatus['id'],
                    'text' => $rawStatus['text'],
                    'date' => $rawStatus['created_at']
                );
            }
        }


        return $this->statuses;
    }
}