<?php

namespace ViKon\Bootstrap\Console\Command;

use Illuminate\Console\Command;
use ViKon\Bootstrap\Compiler;

class CompileCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->signature   = 'vi-kon:bootstrap:compile '
                             . '{component?* : Compile only listed components}'
                             . '{--force    : Force overwrite existing files}'
                             . '{--all      : Include all components}'
                             . '{--except=* : Exclude component (Available only if --all option is set)}';
        $this->description = 'Compile latest Bootstrap framework with JavaScript and CSS files into public directory';

        parent::__construct();
    }

    public function handle()
    {
        $compiler = app(Compiler::class);

        $compiler->setOutput($this->output);

        // Enable components for compiler
        if ($this->option('all')) {
            $compiler->enableAll($this->option('except'));
        } else {
            foreach ($this->argument('component') as $name) {
                $compiler->enableComponent($name);
            }
        }

        $compiler->compile($this->option('force'));
    }

}