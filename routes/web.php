<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

Route::name('filament.')
    ->group(function () {
        foreach (Filament::getPanels() as $panel) {
            /** @var \Filament\Panel $panel */
            $panelId = $panel->getId();
            $hasTenancy = $panel->hasTenancy();
            $tenantRoutePrefix = $panel->getTenantRoutePrefix();
            $tenantSlugAttribute = $panel->getTenantSlugAttribute();
            $domains = $panel->getDomains();

            foreach ((empty($domains) ? [null] : $domains) as $domain) {
                Route::domain($domain)
                    ->middleware($panel->getMiddleware())
                    ->name("{$panelId}.")
                    ->prefix($panel->getPath().'/reports')
                    ->group(function () use ($panel, $hasTenancy, $tenantRoutePrefix, $tenantSlugAttribute) {

                        Route::middleware($panel->getAuthMiddleware())
                            ->group(function () use ($panel, $hasTenancy, $tenantRoutePrefix, $tenantSlugAttribute): void {
                                Route::middleware($hasTenancy ? $panel->getTenantMiddleware() : [])
                                    ->prefix($hasTenancy ? (($tenantRoutePrefix) ? "{$tenantRoutePrefix}/" : '').('{tenant'.(($tenantSlugAttribute) ? ":{$tenantSlugAttribute}" : '').'}') : '')
                                    ->group(function () use ($panel): void {
                                        Route::name('reports.')->group(function () use ($panel): void {
                                            foreach (reports()->getReports() as $report) {
                                                $report::routes($panel);
                                            }
                                        });
                                    });

                            });
                    });
            }
        }
    });
