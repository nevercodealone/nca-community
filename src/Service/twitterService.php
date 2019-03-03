<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Simplon\Twitter\Twitter;

class twitterService
{
    private $cache;
    private $twitterEntity;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public $twitter;
    public $stopRequests = false;
    public $maxId = null;
    public $statuses;
    public $requestCount = 0;

    public function __construct(EntityManagerInterface $entityManager)
    {
//        $this->cache = $cache;
        $this->entityManager = $entityManager;
        $this->twitter = new Twitter($_SERVER['API_KEY'], $_SERVER['API_SECRET']);
        $this->authorize();
    }

    protected function authorize()
    {
        $this->twitter->setOauthTokens($_SERVER['ACCESS_TOKEN'], $_SERVER['ACCESS_SECRET']);
    }

    public function crawlerCommand() {
        $entityManager = $this->entityManager;

        $tweets = $this->getActualTweetsFromUsers();


        foreach ($tweets as $tweet) {
            $tweeterEntity = new \App\Entity\Twitter();
            $tweeterEntity->setJson($tweet);
            $entityManager->persist($tweeterEntity);
        }

        $entityManager->flush();

        return count($this->getActualTweetsFromUsers());
    }

    protected function getActualTweetsFromUsers(): array
    {
        $statuses = [];
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
                $statuses[] = serialize($rawStatus);
            }
        }

        return $statuses;
    }
}