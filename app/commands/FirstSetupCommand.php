<?php

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class FirstSetupCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'byscripts:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial setup for new projects.';
    private $projectName;
    private $sProjectName;
    private $uProjectName;
    private $domainName;

    public function ask($question, $default = null)
    {
        if (null === $default) {
            return parent::ask($question . ' ', $default);
        }

        $displayDefault = trim(var_export($default, true), '\'');

        return parent::ask($question . ' [' . $displayDefault . '] ', $default);
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->projectName  = $this->ask('Project name:');
        $this->sProjectName = Str::slug($this->projectName);
        $this->uProjectName = Str::slug($this->projectName, '_');
        $this->domainName   = $this->ask('Prod domain name:', $this->getDefaultProdDomainName());

        $this->line('');
        $this->info('If you want to skip a configuration for the moment, enter ~ as a value.');
        $this->line('');

        $this->startParsing();
    }

    private function startParsing()
    {
        $finder = new Finder();

        /** @var Symfony\Component\Finder\SplFileInfo $file */
        foreach ($finder->files()->in(__DIR__ . '/../config') as $file) {

            $hasMatch = false;
            $content  = $file->getContents();
            preg_match_all('`/\* BYSCRIPTS_SETUP\:([^\:]+):([^\*]+)\*/`', $content, $matches, PREG_SET_ORDER);

            if (!empty($matches)) {

                $title = sprintf('Configuring %s...', $file->getRelativePathname());
                $this->line('');
                $this->info($sep = str_repeat('=', strlen($title)));
                $this->info($title);
                $this->info($sep);
                $this->line('');

                $hasMatch = true;

                foreach ($matches as $match) {
                    $source   = $match[0];
                    $question = trim($match[1]);
                    $default  = trim($match[2]);

                    if (0 === strpos($default, '@')) {
                        $method  = trim($default, '@');
                        $default = call_user_func([$this, $method]);
                    }

                    $value = $this->ask($question, $default);

                    if ('~' === $value) {
                        continue;
                    }

                    $content = str_replace($source, $value, $content);
                }
            }

            if ($hasMatch) {
                file_put_contents($file->getPathname(), $content);
                $this->line('');
                $this->comment('>>> File updated...');
            }
        }
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    private function getDefaultProdDomainName()
    {
        return $this->sProjectName . '.com';
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    private function getDefaultProdUrl()
    {
        return 'http://' . $this->domainName;
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    private function getDefaultDevUrl()
    {
        return 'http://' . $this->domainName . '.local';
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    private function getDefaultFromEmailAddress()
    {
        return 'contact@' . $this->domainName;
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    private function generateKey()
    {
        return Str::random(32);
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    private function getDefaultDbName()
    {
        return Str::limit($this->uProjectName, 64, '');
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    private function getProjectName()
    {
        return $this->projectName;
    }
}
