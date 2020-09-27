<?php declare(strict_types=1);

namespace Synlab\FooterConversion\Storefront\Pagelet\Footer\Subscriber;

use Shopware\Storefront\Pagelet\Footer\FooterPageletLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Core\Framework\Struct\ArrayEntity;

class FooterPageletLoadedSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            FooterPageletLoadedEvent::class => 'onFooterPageletLoaded'
        ];
    }

    public function onFooterPageletLoaded(FooterPageletLoadedEvent $event): void
    {
        $systemConfig = $this->systemConfigService->get('FooterConversion.config');
        $page = $event->getPagelet();

        $page->addExtension('FooterConversion', new ArrayEntity($systemConfig));

        /*echo '<pre>';
        print_r($systemConfig);
        echo 'hi';
        die();*/
    }

    /**
     * @var SystemConfigService
     * 
     * $backgroundColor = $this->systemConfigService->get('SynlabPlatformConversionHeaderPro.config.backgroundColor');
     * 
     */
    private $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }
}