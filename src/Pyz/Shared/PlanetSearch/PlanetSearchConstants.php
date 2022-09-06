<?php

namespace Pyz\Shared\PlanetSearch;

class PlanetSearchConstants {

    /**
     * Specification:
     * - Queue name as used for processing planet messages
     *
     * @api
     *
     * @var string
     */
    public const PLANET_SYNC_SEARCH_QUEUE = 'sync.search.planet';
}
