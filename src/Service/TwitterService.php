<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\CacheItemPoolInterface;
use DG\Twitter\Twitter;

class TwitterService
{
    private $twitterEntity;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public $twitter;
    private $cache;
    public $stopRequests = false;
    public $maxId = null;
    public $statuses;
    public $requestCount = 0;

    public function __construct(EntityManagerInterface $entityManager, Twitter $twitter, CacheItemPoolInterface $cache)
    {
        $this->entityManager = $entityManager;
        $this->twitter = $twitter;
        $this->cache = $cache;
    }

    public function crawlerCommand() {
        $cacheItem = $this->cache->getItem('timeline');
        $getTweets = $this->getActualTweetsFromUsers();
        $cacheItem->set($getTweets);
        $this->cache->save($cacheItem);

        return count($getTweets);
    }

    public function getTweets()
    {
        $cacheItem = $this->cache->getItem('timeline');

        if (!$cacheItem->isHit()) {
            return false;    
        }

        $cacheItem->set($this->getActualTweetsFromUsers());
        $this->cache->save($cacheItem);

        return $cacheItem->get();
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
                'count' => 5
            );

            if(!empty($this->maxId)) {
                $getConfig['max_id'] = number_format($this->maxId, 0, '.', '');
            }

            $this->requestCount++;

            $rawStatuses = $this->twitter->request('statuses/user_timeline', 'GET', $getConfig);

            foreach($rawStatuses as $rawStatus) {
                $statuses[] = [
                    'time' => '',
                    'html' => $this->getEmbedCodeByUrl('https://twitter.com/' . $user . '/status/' . $rawStatus->id)
                ];
            }
        }

        return $statuses;
    }

    public function getEmbedCodeByUrl($url)
    {
        $res = $this->twitter->request('statuses/oembed', 'GET', ['url' => $url, 'maxwidth' => '670']);
        return $res->html;
    }
}
