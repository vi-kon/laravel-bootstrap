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
class CompileBootstrap {

    /**
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem) {
        $configPath = config_path('bootstrap.components.php');

        $outputCssPath = config('bootstrap.outputDirectory') . '/bootstrap.min.css';
        $outputJsPath = config('bootstrap.outputDirectory') . '/bootstrap.min.js';

        if (
            config('bootstrap.force', false)
            || !$filesystem->exists($outputCssPath)
            || !$filesystem->exists($outputJsPath)
            || !$filesystem->exists($configPath)
            || $filesystem->lastModified($outputCssPath) < $filesystem->lastModified($configPath)
        ) {
            $filesystem->put($outputCssPath, $this->createCss());
            $filesystem->put($outputJsPath, $this->createJs());
        }
    }

    private function createJs() {
        $minifier = new MinifierJs();

        // Components
        if (config('bootstrap.components.dropdowns')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/dropdown.js'));
        }

        // Components w/ JavaScript
        if (config('bootstrap.components.modals')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/modal.js'));
        }
        if (config('bootstrap.components.tooltip')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/tooltip.js'));
        }
        if (config('bootstrap.components.popovers')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/popover.js'));
        }
        if (config('bootstrap.components.carousel')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/carousel.js'));
        }

        // Pure JavaScript components
        if (config('bootstrap.components.affix')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/affix.js'));
        }
        if (config('bootstrap.components.alert')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/alert.js'));
        }
        if (config('bootstrap.components.button')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/button.js'));
        }
        if (config('bootstrap.components.collapse')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/collapse.js'));
        }
        if (config('bootstrap.components.scrollspy')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/scrollspy.js'));
        }
        if (config('bootstrap.components.tab')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/tab.js'));
        }
        if (config('bootstrap.components.transition')) {
            $minifier->add(base_path('vendor/twbs/bootstrap/js/transition.js'));
        }

        return $minifier->minify();
    }

    /**
     * Create virtual bootstrap.components.less by config file settings
     *
     * @return string
     */
    private function createCss() {
        $output = '';

        // Core variables and mixins
        $output .= '@import "variables.less";';
        $output .= '@import "mixins.less";';

        // Reset and dependencies
        if (config('bootstrap.components.normalize')) {
            $output .= '@import "normalize.less";';
        }
        if (config('bootstrap.components.print')) {
            $output .= '@import "print.less";';
        }
        if (config('bootstrap.components.glyphicons')) {
            $output .= '@import "glyphicons.less";';
        }

        // Core CSS
        if (config('bootstrap.components.scaffolding')) {
            $output .= '@import "scaffolding.less";';
        }
        if (config('bootstrap.components.type')) {
            $output .= '@import "type.less";';
        }
        if (config('bootstrap.components.code')) {
            $output .= '@import "code.less";';
        }
        if (config('bootstrap.components.grid')) {
            $output .= '@import "grid.less";';
        }
        if (config('bootstrap.components.tables')) {
            $output .= '@import "tables.less";';
        }
        if (config('bootstrap.components.forms')) {
            $output .= '@import "forms.less";';
        }
        if (config('bootstrap.components.buttons')) {
            $output .= '@import "buttons.less";';
        }

        // Components
        if (config('bootstrap.components.component-animations')) {
            $output .= '@import "component-animations.less";';
        }
        if (config('bootstrap.components.dropdowns')) {
            $output .= '@import "dropdowns.less";';
        }
        if (config('bootstrap.components.button-groups')) {
            $output .= '@import "button-groups.less";';
        }
        if (config('bootstrap.components.input-groups')) {
            $output .= '@import "input-groups.less";';
        }
        if (config('bootstrap.components.navs')) {
            $output .= '@import "navs.less";';
        }
        if (config('bootstrap.components.navbar')) {
            $output .= '@import "navbar.less";';
        }
        if (config('bootstrap.components.breadcrumbs')) {
            $output .= '@import "breadcrumbs.less";';
        }
        if (config('bootstrap.components.pagination')) {
            $output .= '@import "pagination.less";';
        }
        if (config('bootstrap.components.pager')) {
            $output .= '@import "pager.less";';
        }
        if (config('bootstrap.components.labels')) {
            $output .= '@import "labels.less";';
        }
        if (config('bootstrap.components.badges')) {
            $output .= '@import "badges.less";';
        }
        if (config('bootstrap.components.jumbotron')) {
            $output .= '@import "jumbotron.less";';
        }
        if (config('bootstrap.components.thumbnails')) {
            $output .= '@import "thumbnails.less";';
        }
        if (config('bootstrap.components.alerts')) {
            $output .= '@import "alerts.less";';
        }
        if (config('bootstrap.components.progress-bars')) {
            $output .= '@import "progress-bars.less";';
        }
        if (config('bootstrap.components.media')) {
            $output .= '@import "media.less";';
        }
        if (config('bootstrap.components.list-group')) {
            $output .= '@import "list-group.less";';
        }
        if (config('bootstrap.components.panels')) {
            $output .= '@import "panels.less";';
        }
        if (config('bootstrap.components.responsive-embed')) {
            $output .= '@import "responsive-embed.less";';
        }
        if (config('bootstrap.components.wells')) {
            $output .= '@import "wells.less";';
        }
        if (config('bootstrap.components.close')) {
            $output .= '@import "close.less";';
        }

        // Components w/ JavaScript
        if (config('bootstrap.components.modals')) {
            $output .= '@import "modals.less";';
        }
        if (config('bootstrap.components.tooltip')) {
            $output .= '@import "tooltip.less";';
        }
        if (config('bootstrap.components.popovers')) {
            $output .= '@import "popovers.less";';
        }
        if (config('bootstrap.components.carousel')) {
            $output .= '@import "carousel.less";';
        }

        // Utility classes
        if (config('bootstrap.components.utilities')) {
            $output .= '@import "utilities.less";';
        }
        if (config('bootstrap.components.responsive-utilities')) {
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