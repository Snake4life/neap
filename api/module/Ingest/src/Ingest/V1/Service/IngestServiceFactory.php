<?php
/**
 * Neap (http://neap.io/)
 *
 * @link      http://github.com/e7d/neap for the canonical source repository
 * @copyright Copyright (c) 2015 e7d (http://e7d.io)
 * @license   https://github.com/e7d/neap/blob/master/LICENSE.md The MIT License
 */

namespace Ingest\V1\Service;

class IngestServiceFactory
{
    public function __invoke($services)
    {
        return new IngestService(
            $services->get('Application\Database\Ingest\IngestModel'),
            $services->get('Application\Hydrator\Ingest\IngestHydrator'),
            $services->get('Application\Database\Outage\OutageModel'),
            $services->get('Application\Hydrator\Outage\OutageHydrator')
        );
    }
}
