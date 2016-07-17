<?php
/**
 * Neap (http://neap.io/)
 *
 * @link      http://github.com/e7d/neap for the canonical source repository
 * @copyright Copyright (c) 2016 Michaël "e7d" Ferrand (http://github.com/e7d)
 * @license   https://github.com/e7d/neap/blob/master/LICENSE.txt The MIT License
 */

namespace Application\Hydrator\Panel;

use Application\Database\Channel\ChannelModel;
use Application\Database\Panel\Panel;
use Application\Hydrator\Hydrator;
use ZF\Hal\Entity;

/**
 * PanelHydrator
 */
class PanelHydrator extends Hydrator
{
    /** @var ChannelModel */
    protected $channelModel;

    /**
     * @param ChannelModel $channelModel
     */
    public function __construct(ChannelModel $channelModel)
    {
        parent::__construct();
        $this->channelModel = $channelModel;
    }

    /**
     * @param Panel $panel
     *
     * @return Entity
     */
    public function buildEntity($panel)
    {
        $this->object = $panel;

        $channel = $this->channelModel->fetch($panel->channel_id);

        $this->addEmbed('embedChannel', $channel);

        $this->entity = new Entity($this->extract($panel), $panel->panel_id);

        $this->addSelfLink();
        $this->addLink('linkChannel', $channel);

        return $this->entity;
    }
}
