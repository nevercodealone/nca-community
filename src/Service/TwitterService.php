<?php

namespace App\Service;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\CacheItemPoolInterface;
use DG\Twitter\Twitter;

class TwitterService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public $twitter;
    private $cache;

    public function __construct(EntityManagerInterface $entityManager, Twitter $twitter, CacheItemPoolInterface $cache, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->twitter = $twitter;
        $this->cache = $cache;
        $this->userRepository = $userRepository;
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

        $query = 'from:';

        $users = $this->userRepository->findAll();
        foreach ($users as $key => $user) {
            if(0 !== $key) {
                $query .= '+OR+from:';
            }

            $query .= $user->getTwitter();
        }

        $params = [
            'q' => $query,
            'count' => 20,
            'result_type' => 'recent'
        ];
        $statuses = $this->twitter->search($params, true);

        $tweets = [];

        foreach($statuses->statuses as $status) {
            if (isset($status->retweeted_status)) {
                continue;
            }

            $user = $status->user->screen_name;
            $tweets[] = [
                'time' => '',
                'html' => $this->getEmbedCodeByUrl('https://twitter.com/' . $user . '/status/' . $status->id)
            ];
        }

        return $tweets;
    }

    public function getEmbedCodeByUrl($url)
    {
        $res = $this->twitter->request('statuses/oembed', 'GET', ['url' => $url, 'maxwidth' => '670']);
        return $res->html;
    }
}
