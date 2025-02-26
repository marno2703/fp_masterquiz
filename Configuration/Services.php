<?php
declare(strict_types=1);

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use TYPO3\CMS\Dashboard\Widgets\BarChartWidget;
use TYPO3\CMS\Backend\View\BackendViewFactory;
use Fixpunkt\FpMasterquiz\Widgets\Provider\ParticipantsDataProvider;
use Fixpunkt\FpMasterquiz\Widgets\RecentParticipantsWidget;

return function (ContainerConfigurator $configurator, ContainerBuilder $containerBuilder) {
    if ($containerBuilder->hasDefinition(BarChartWidget::class)) {
        $services = $configurator->services();

        $services->set('dashboard.widget.fixpunktRecentParticipants')
            ->class(RecentParticipantsWidget::class)
            ->arg('$backendViewFactory', new Reference(BackendViewFactory::class))
            ->arg('$dataProvider', new Reference(ParticipantsDataProvider::class))
            ->tag(
                'dashboard.widget',
                [
                    'identifier' => 'fixpunktRecentParticipants',
                    'groupNames' => 'fixpunkt',
                    'title' => 'LLL:EXT:fp_masterquiz/Resources/Private/Language/locallang_be.xlf:dashboard.widget.fixpunktRecentParticipants.title',
                    'description' => 'LLL:EXT:fp_masterquiz/Resources/Private/Language/locallang_be.xlf:dashboard.widget.fixpunktRecentParticipants.description',
                    'iconIdentifier' => 'content-widget-list',
                    'height' => 'medium',
                    'width' => 'medium'
                ]
            );

        $services->set('dashboard.widget.fixpunktLastDays')
            ->class(BarChartWidget::class)
            ->tag(
                'dashboard.widget',
                [
                    'identifier' => 'fixpunktLastDays',
                    'groupNames' => 'fixpunkt',
                    'title' => 'LLL:EXT:fp_masterquiz/Resources/Private/Language/locallang_be.xlf:dashboard.widget.fixpunktLastDays.title',
                    'description' => 'LLL:EXT:fp_masterquiz/Resources/Private/Language/locallang_be.xlf:dashboard.widget.fixpunktLastDays.description',
                    'iconIdentifier' => 'content-widget-chart-bar',
                    'height' => 'medium',
                    'width' => 'medium'
                ]
            )
            ->arg('$dataProvider', new Reference(ParticipantsDataProvider::class))
            ->arg('$backendViewFactory', new Reference(BackendViewFactory::class));
    }
};
