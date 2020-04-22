<?php

namespace Ayesh\ComposerAutoloadMin;

use Composer\Command\BaseCommand;
use Composer\Plugin\Capability\CommandProvider;

class DumpAutoloadMinCommandProvider implements CommandProvider {

    /**
     * Retrieves an array of commands
     *
     * @return BaseCommand[]
     */
    public function getCommands(): array {
        return [
            new DumpAutololoadMinCommand(),
        ];
    }
}
