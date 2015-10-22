<?php

namespace ViKon\Bootstrap;

use Illuminate\Filesystem\Filesystem;
use MatthiasMullie\Minify as Minify;
use Symfony\Component\Console\Output\OutputInterface;
use ViKon\Bootstrap\Exception\NotValidCompoenentException;

/**
 * Class Compiler
 *
 * @package ViKon\Bootstrap
 *
 * @author  Kovács Vince<vincekovacs@hotmail.com>
 */
class Compiler
{
    /** @type \Illuminate\Filesystem\Filesystem */
    protected $filesystem;

    /** @type bool[] */
    protected $components = [
        // Reset and dependencies
        'normalize'            => false,
        'print'                => false,
        'glyphicons'           => false,
        // Core CSS
        'scaffolding'          => false,
        'type'                 => false,
        'code'                 => false,
        'grid'                 => false,
        'tables'               => false,
        'forms'                => false,
        'buttons'              => false,
        // Components
        'component-animations' => false,
        'dropdowns'            => false,
        'button-groups'        => false,
        'input-groups'         => false,
        'navs'                 => false,
        'navbar'               => false,
        'breadcrumbs'          => false,
        'pagination'           => false,
        'pager'                => false,
        'labels'               => false,
        'badges'               => false,
        'jumbotron'            => false,
        'thumbnails'           => false,
        'alerts'               => false,
        'progress-bars'        => false,
        'media'                => false,
        'list-group'           => false,
        'panels'               => false,
        'responsive-embed'     => false,
        'wells'                => false,
        'close'                => false,
        // Components w/ JavaScript
        'modals'               => false,
        'tooltip'              => false,
        'popovers'             => false,
        'carousel'             => false,
        // Pure JavaScript components
        'affix'                => false,
        'alert'                => false,
        'button'               => false,
        'collapse'             => false,
        'scrollspy'            => false,
        'tab'                  => false,
        'transition'           => false,
        // Utility classes
        'utilities'            => false,
        'responsive-utilities' => false,
    ];

    /** @type string[] */
    protected $outputPath = [];

    /** @type \Symfony\Component\Console\Output\OutputInterface */
    protected $output;

    /**
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->outputPath = [
            'js'  => public_path('vendor/bootstrap'),
            'css' => public_path('vendor/bootstrap'),
        ];
    }

    /**
     * Enable named component for compiler
     *
     * @param string $name component name
     *
     * @return $this
     */
    public function enableComponent($name)
    {
        if (!array_key_exists($name, $this->components)) {
            throw new NotValidCompoenentException($name . ' component is not valid');
        }

        $this->components[$name] = true;

        return $this;
    }

    /**
     * Enable all components except listed ones
     *
     * @param string[] $except list of components that will be not enabled
     *
     * @return $this
     */
    public function enableAll(array $except = [])
    {
        // Check if excluded components name are exists or not
        foreach ($except as $name) {
            if (!array_key_exists($name, $this->components)) {
                throw new NotValidCompoenentException($name . ' component is not valid');
            }
        }

        // Enable components
        foreach ($this->components as $name => &$status) {
            $status = !in_array($name, $except, true);
        }

        return $this;
    }

    /**
     * Overwrite default compile path for javascript and stylesheet files
     *
     * bootstrap.min.css and bootstrap.min.js file names are used as output file names
     *
     * @param string $jsPath  path for javascript output file
     * @param string $cssPath path for css output file
     *
     * @return $this
     */
    public function setPaths($jsPath, $cssPath)
    {
        $this->outputPath = [
            'js'  => $jsPath,
            'css' => $cssPath,
        ];

        return $this;
    }

    /**
     * Set output interface for output messages
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return $this
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Disable all components
     *
     * @return $this
     */
    public function reset()
    {
        foreach ($this->components as &$component) {
            $component = false;
        }
        unset($component);

        return $this;
    }

    /**
     * Compile enabled components
     *
     * @param bool $force if TRUE cache will be invalidated and new compiled resources will be created
     *
     * @return void
     *
     * @throws \ViKon\Bootstrap\Exception\CompilerException
     */
    public function compile($force = false)
    {
        $jsOutputPath  = $this->outputPath['js'] . '/bootstrap.min.js';
        $cssOutputPath = $this->outputPath['css'] . '/bootstrap.min.css';

        if ($force === true || !$this->filesystem->exists($jsOutputPath)) {
            $this->filesystem->makeDirectory(dirname($jsOutputPath), 0755, true, true);
            $this->filesystem->put($jsOutputPath, $this->minifyJs());
            $this->lineToOutput('Compiled <info>JavaScript</info> was successfully written to <info>' . $jsOutputPath . '</info> file');
        }

        if ($force === true || !$this->filesystem->exists($cssOutputPath)) {
            $this->filesystem->makeDirectory(dirname($cssOutputPath), 0755, true, true);
            $this->filesystem->put($cssOutputPath, $this->minifyCss());
            $this->lineToOutput('Compiled <info>StyleSheet</info> was successfully written to <info>' . $jsOutputPath . '</info> file');
        }
    }

    /**
     * Minify JS components to single string
     *
     * @return string
     */
    protected function minifyJs()
    {
        $minifier = new Minify\JS();

        // Components
        $this->addJsToMinifier($minifier, 'dropdowns', 'dropdown');

        // Components w/ JavaScript
        $this->addJsToMinifier($minifier, 'modals', 'modal');
        $this->addJsToMinifier($minifier, 'tooltip');
        $this->addJsToMinifier($minifier, 'popovers', 'popover');
        $this->addJsToMinifier($minifier, 'carousel');

        // Pure JavaScript components
        $this->addJsToMinifier($minifier, 'affix');
        $this->addJsToMinifier($minifier, 'alert');
        $this->addJsToMinifier($minifier, 'button');
        $this->addJsToMinifier($minifier, 'collapse');
        $this->addJsToMinifier($minifier, 'scrollspy');
        $this->addJsToMinifier($minifier, 'tab');
        $this->addJsToMinifier($minifier, 'transition');

        return $minifier->minify();
    }

    /**
     * Add components javascript file to minifier if component is enabled
     *
     * @param \MatthiasMullie\Minify\JS $minify        minifier instance
     * @param string                    $componentName valid component name
     * @param string|null               $fileName      file name (if not set component name is used)
     *
     * @return void
     */
    protected function addJsToMinifier(Minify\JS $minify, $componentName, $fileName = null)
    {
        if ($fileName === null) {
            $fileName = $componentName;
        }

        // Add component data to minifier if it is enabled
        if ($this->components[$componentName] === true) {
            $minify->add(base_path("vendor/twbs/bootstrap/js/{$fileName}.js"));
        }
    }

    /**
     * Write line to output
     *
     * If output not exists do nothing
     *
     * @param string $line
     *
     * @return void
     */
    protected function lineToOutput($line)
    {
        if ($this->output !== null) {
            $this->output->writeln($line);
        }
    }

    /**
     * Minify CSS
     *
     * @return string
     */
    protected function minifyCss()
    {
        $output = '';

        // Core variables and mixins
        $output .= '@import "variables.less";';
        $output .= '@import "mixins.less";';

        // Reset and dependencies
        $output .= $this->prepareCssForLess('normalize');
        $output .= $this->prepareCssForLess('print');
        $output .= $this->prepareCssForLess('glyphicons');

        // Core CSS
        $output .= $this->prepareCssForLess('scaffolding');
        $output .= $this->prepareCssForLess('type');
        $output .= $this->prepareCssForLess('code');
        $output .= $this->prepareCssForLess('grid');
        $output .= $this->prepareCssForLess('tables');
        $output .= $this->prepareCssForLess('forms');
        $output .= $this->prepareCssForLess('buttons');

        // Components
        $output .= $this->prepareCssForLess('component-animations');
        $output .= $this->prepareCssForLess('dropdowns');
        $output .= $this->prepareCssForLess('button-groups');
        $output .= $this->prepareCssForLess('input-groups');
        $output .= $this->prepareCssForLess('navs');
        $output .= $this->prepareCssForLess('navbar');
        $output .= $this->prepareCssForLess('breadcrumbs');
        $output .= $this->prepareCssForLess('pagination');
        $output .= $this->prepareCssForLess('pager');
        $output .= $this->prepareCssForLess('labels');
        $output .= $this->prepareCssForLess('badges');
        $output .= $this->prepareCssForLess('jumbotron');
        $output .= $this->prepareCssForLess('thumbnails');
        $output .= $this->prepareCssForLess('alerts');
        $output .= $this->prepareCssForLess('progress-bars');
        $output .= $this->prepareCssForLess('media');
        $output .= $this->prepareCssForLess('list-group');
        $output .= $this->prepareCssForLess('panels');
        $output .= $this->prepareCssForLess('responsive-embed');
        $output .= $this->prepareCssForLess('wells');
        $output .= $this->prepareCssForLess('close');

        // Components w/ JavaScript
        $output .= $this->prepareCssForLess('modals');
        $output .= $this->prepareCssForLess('tooltip');
        $output .= $this->prepareCssForLess('popovers');
        $output .= $this->prepareCssForLess('carousel');

        // Utility classes
        $output .= $this->prepareCssForLess('utilities');
        $output .= $this->prepareCssForLess('responsive-utilities');

        $less = new \Less_Parser();
        $less->SetImportDirs([base_path('vendor/twbs/bootstrap/less') => 'bootstrap']);

        $css = $less->parse($output, 'bootstrap.components.less')->getCss();

        $minifier = new Minify\CSS();
        $minifier->add($css);

        return $minifier->minify();
    }

    /**
     * Prepare components less file for less processor's input if component is enabled
     *
     * @param string      $componentName valid component name
     * @param string|null $fileName      file name (if not set component name is used)
     *
     * @return string
     */
    protected function prepareCssForLess($componentName, $fileName = null)
    {
        if ($fileName === null) {
            $fileName = $componentName;
        }

        // Add component data to minifier if it is enabled
        if ($this->components[$componentName] === true) {
            return "@import \"{$fileName}.less\";";
        }

        return '';
    }
}