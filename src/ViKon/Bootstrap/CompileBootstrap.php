<?php

namespace ViKon\Bootstrap;

use Illuminate\Filesystem\Filesystem;
use MatthiasMullie\Minify\CSS as MinifierCss;
use MatthiasMullie\Minify\JS as MinifierJs;

/**
 * Class BuildBootstrap
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\Bootstrap
 */
class CompileBootstrap
{
    /**
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $configPath = config_path('bootstrap.components.php');

        $outputCssPath = config('vi-kon.bootstrap.outputDirectory') . '/bootstrap.min.css';
        $outputJsPath  = config('vi-kon.bootstrap.outputDirectory') . '/bootstrap.min.js';

        if (
            config('vi-kon.bootstrap.force', false)
            || !$filesystem->exists($outputCssPath)
            || !$filesystem->exists($outputJsPath)
            || !$filesystem->exists($configPath)
            || $filesystem->lastModified($outputCssPath) < $filesystem->lastModified($configPath)
        ) {
            $filesystem->put($outputCssPath, $this->createCss());
            $filesystem->put($outputJsPath, $this->createJs());
        }
    }

    private function createJs()
    {
        $minifier = new MinifierJs();

        // Components
        if (config('vi-kon.bootstrap.components.dropdowns')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/dropdown.js'));
        }

        // Components w/ JavaScript
        if (config('vi-kon.bootstrap.components.modals')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/modal.js'));
        }
        if (config('vi-kon.bootstrap.components.tooltip')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/tooltip.js'));
        }
        if (config('vi-kon.bootstrap.components.popovers')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/popover.js'));
        }
        if (config('vi-kon.bootstrap.components.carousel')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/carousel.js'));
        }

        // Pure JavaScript components
        if (config('vi-kon.bootstrap.components.affix')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/affix.js'));
        }
        if (config('vi-kon.bootstrap.components.alert')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/alert.js'));
        }
        if (config('vi-kon.bootstrap.components.button')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/button.js'));
        }
        if (config('vi-kon.bootstrap.components.collapse')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/collapse.js'));
        }
        if (config('vi-kon.bootstrap.components.scrollspy')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/scrollspy.js'));
        }
        if (config('vi-kon.bootstrap.components.tab')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/tab.js'));
        }
        if (config('vi-kon.bootstrap.components.transition')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/transition.js'));
        }

        return $minifier->minify();
    }

    /**
     * Create virtual bootstrap.components.less by config file settings
     *
     * @return string
     */
    private function createCss()
    {
        $output = '';

        // Core variables and mixins
        $output .= '@import "variables.less";';
        $output .= '@import "mixins.less";';

        // Reset and dependencies
        if (config('vi-kon.bootstrap.components.normalize')) {
            $output .= '@import "normalize.less";';
        }
        if (config('vi-kon.bootstrap.components.print')) {
            $output .= '@import "print.less";';
        }
        if (config('vi-kon.bootstrap.components.glyphicons')) {
            $output .= '@import "glyphicons.less";';
        }

        // Core CSS
        if (config('vi-kon.bootstrap.components.scaffolding')) {
            $output .= '@import "scaffolding.less";';
        }
        if (config('vi-kon.bootstrap.components.type')) {
            $output .= '@import "type.less";';
        }
        if (config('vi-kon.bootstrap.components.code')) {
            $output .= '@import "code.less";';
        }
        if (config('vi-kon.bootstrap.components.grid')) {
            $output .= '@import "grid.less";';
        }
        if (config('vi-kon.bootstrap.components.tables')) {
            $output .= '@import "tables.less";';
        }
        if (config('vi-kon.bootstrap.components.forms')) {
            $output .= '@import "forms.less";';
        }
        if (config('vi-kon.bootstrap.components.buttons')) {
            $output .= '@import "buttons.less";';
        }

        // Components
        if (config('vi-kon.bootstrap.components.component-animations')) {
            $output .= '@import "component-animations.less";';
        }
        if (config('vi-kon.bootstrap.components.dropdowns')) {
            $output .= '@import "dropdowns.less";';
        }
        if (config('vi-kon.bootstrap.components.button-groups')) {
            $output .= '@import "button-groups.less";';
        }
        if (config('vi-kon.bootstrap.components.input-groups')) {
            $output .= '@import "input-groups.less";';
        }
        if (config('vi-kon.bootstrap.components.navs')) {
            $output .= '@import "navs.less";';
        }
        if (config('vi-kon.bootstrap.components.navbar')) {
            $output .= '@import "navbar.less";';
        }
        if (config('vi-kon.bootstrap.components.breadcrumbs')) {
            $output .= '@import "breadcrumbs.less";';
        }
        if (config('vi-kon.bootstrap.components.pagination')) {
            $output .= '@import "pagination.less";';
        }
        if (config('vi-kon.bootstrap.components.pager')) {
            $output .= '@import "pager.less";';
        }
        if (config('vi-kon.bootstrap.components.labels')) {
            $output .= '@import "labels.less";';
        }
        if (config('vi-kon.bootstrap.components.badges')) {
            $output .= '@import "badges.less";';
        }
        if (config('vi-kon.bootstrap.components.jumbotron')) {
            $output .= '@import "jumbotron.less";';
        }
        if (config('vi-kon.bootstrap.components.thumbnails')) {
            $output .= '@import "thumbnails.less";';
        }
        if (config('vi-kon.bootstrap.components.alerts')) {
            $output .= '@import "alerts.less";';
        }
        if (config('vi-kon.bootstrap.components.progress-bars')) {
            $output .= '@import "progress-bars.less";';
        }
        if (config('vi-kon.bootstrap.components.media')) {
            $output .= '@import "media.less";';
        }
        if (config('vi-kon.bootstrap.components.list-group')) {
            $output .= '@import "list-group.less";';
        }
        if (config('vi-kon.bootstrap.components.panels')) {
            $output .= '@import "panels.less";';
        }
        if (config('vi-kon.bootstrap.components.responsive-embed')) {
            $output .= '@import "responsive-embed.less";';
        }
        if (config('vi-kon.bootstrap.components.wells')) {
            $output .= '@import "wells.less";';
        }
        if (config('vi-kon.bootstrap.components.close')) {
            $output .= '@import "close.less";';
        }

        // Components w/ JavaScript
        if (config('vi-kon.bootstrap.components.modals')) {
            $output .= '@import "modals.less";';
        }
        if (config('vi-kon.bootstrap.components.tooltip')) {
            $output .= '@import "tooltip.less";';
        }
        if (config('vi-kon.bootstrap.components.popovers')) {
            $output .= '@import "popovers.less";';
        }
        if (config('vi-kon.bootstrap.components.carousel')) {
            $output .= '@import "carousel.less";';
        }

        // Utility classes
        if (config('vi-kon.bootstrap.components.utilities')) {
            $output .= '@import "utilities.less";';
        }
        if (config('vi-kon.bootstrap.components.responsive-utilities')) {
            $output .= '@import "responsive-utilities.less";';
        }

        $less = new \Less_Parser();
        $less->SetImportDirs([
            base_path('vendor/twbs/bootstrap/less') => 'bootstrap',
        ]);

        $css = $less->parse($output, 'bootstrap.components.less')->getCss();

        $minifier = new MinifierCss();
        $minifier->add($css);

        return $minifier->minify();
    }
}