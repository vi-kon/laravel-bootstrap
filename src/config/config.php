<?php

return [
    /*
    | --------------------------------------------------------------------------
    | Output minifiing
    | --------------------------------------------------------------------------
    | If false generated javascript and css files are minified
    |
    */
    'minify'     => false,

    /*
    | --------------------------------------------------------------------------
    | Forcing generation
    | --------------------------------------------------------------------------
    | Force package to regenerate files
    |
    */
    'force'      => false,

    /*
    | --------------------------------------------------------------------------
    | Components
    | --------------------------------------------------------------------------
    | Options for enabling or disabling bootstrap modules
    |
    */
    'components' => [
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
    ],
];
