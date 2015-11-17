<?php
/**
 * Neap (http://neap.io/)
 *
 * @link      http://github.com/e7d/neap for the canonical source repository
 * @copyright Copyright (c) 2015 e7d (http://e7d.io)
 * @license   https://github.com/e7d/neap/blob/master/LICENSE.md The MIT License
 */

namespace Application\Hydrator\Topic;

use Application\Hydrator\Hydrator;
use ZF\Hal\Entity;
use ZF\Hal\Link\Link;

class TopicHydrator extends Hydrator
{
    public function __construct()
    {
    }

    public function buildEntity($topic)
    {
        $topicEntity = new Entity($this->extract($topic), $topic->id);

        $topicEntity->getLinks()->add(Link::factory(array(
            'rel' => 'self',
            'route' => array(
                'name' => 'topic.rest.topic',
                'params' => array(
                    'topic_id' => $topic->id,
                ),
            ),
        )));

        return $topicEntity;
    }
}
