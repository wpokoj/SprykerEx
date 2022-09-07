<?php

namespace Pyz\Shared\CmsContentWidgetPlanetConnector\ContentWidgetConfigurationProvider;

use Spryker\Shared\CmsContentWidget\Dependency\CmsContentWidgetConfigurationProviderInterface;

class CmsContentWidgetPlanetConnectorConfigurationProvider
    implements CmsContentWidgetPlanetConnectorConfigurationProviderInterface {

    public const FUNCTION_NAME = 'planet';

    /**
     * @return string
     */
    public function getFunctionName(): string {
        return static::FUNCTION_NAME;
    }

    /**
     * @return array
     */
    public function getAvailableTemplates(): array {
        return [
            CmsContentWidgetConfigurationProviderInterface::DEFAULT_TEMPLATE_IDENTIFIER
                => '@CmsContentWidgetPlanetConnector/views/cms-planet/cms-planet.twig',
        ];
    }

    /**
     * @return string
     */
    public function getUsageInformation(): string {
        return
            "{{ planet(['name']) }}. To use a different template {{ planet(['name'], 'default') }}.";
    }
}
