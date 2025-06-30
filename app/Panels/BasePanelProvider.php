<?php

namespace App\Panels;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;

abstract class BasePanelProvider extends PanelProvider
{
    public function preloadPanelModule(Panel $panel): Panel
    {

        foreach ($this->app['modules']->allEnabled() as $module) {
            $filamentPath = $module->getPath().'/Filament';
            $moduleName = $module->getName();

            if (! is_dir($filamentPath)) {
                continue;
            }

            // get folders in Filament folder, with laravel filesystem
            $filamentPanelFolders = array_filter(glob($filamentPath.'/*'), 'is_dir');

            foreach ($filamentPanelFolders as $filamentPanelFolder) {
                $panelName = basename($filamentPanelFolder);
                if (strtolower($panelName) != $panel->getId()) {
                    continue;
                }

                $panel
                    ->discoverResources(
                        in: $filamentPath.sprintf('/%s/Resources', $panelName),
                        for: sprintf('Modules\%s\Filament\%s\Resources', $moduleName, $panelName),
                    )
                    ->discoverPages(
                        in: $filamentPath.sprintf('/%s/Pages', $panelName),
                        for: sprintf('Modules\%s\Filament\%s\Pages', $moduleName, $panelName),
                    )
                    ->discoverWidgets(
                        in: $filamentPath.sprintf('/%s/Widgets', $panelName),
                        for: sprintf('Modules\%s\Filament\%s\Widgets', $moduleName, $panelName),
                    );
            }
        }

        $panel->plugins([
            SpatieLaravelTranslatablePlugin::make(),
            // SpotlightPlugin::make(),
            BreezyCore::make()
                ->myProfile(
                    shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                    shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                    hasAvatars: true, // Enables the avatar upload form component (default = false)
                    slug: 'profile' // Sets the slug for the profile page (default = 'my-profile')
                ),

        ])
            ->favicon(asset('/images/taklifa.png'));

        return $panel;
    }
}
