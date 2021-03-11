<?php

namespace VendorFPF\WPDesk\Composer\Codeception\Commands;

use VendorFPF\Symfony\Component\Console\Input\InputArgument;
use VendorFPF\Symfony\Component\Console\Input\InputInterface;
use VendorFPF\Symfony\Component\Console\Output\OutputInterface;
/**
 * Codeception tests run command.
 *
 * @package WPDesk\Composer\Codeception\Commands
 */
class RunLocalCodeceptionTests extends \VendorFPF\WPDesk\Composer\Codeception\Commands\RunCodeceptionTests
{
    /**
     * Configure command.
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('run-local-codeception-tests')->setDescription('Run local codeception tests.')->setDefinition(array(new \VendorFPF\Symfony\Component\Console\Input\InputArgument(self::SINGLE, \VendorFPF\Symfony\Component\Console\Input\InputArgument::OPTIONAL, 'Name of Single test to run.', ' '), new \VendorFPF\Symfony\Component\Console\Input\InputArgument(self::WOOCOMMERCE_VERSION, \VendorFPF\Symfony\Component\Console\Input\InputArgument::OPTIONAL, 'WooCommerce version to install.', '')));
    }
    /**
     * Execute command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(\VendorFPF\Symfony\Component\Console\Input\InputInterface $input, \VendorFPF\Symfony\Component\Console\Output\OutputInterface $output)
    {
        $singleTest = $input->getArgument(self::SINGLE);
        $wooVersion = $input->getArgument(self::WOOCOMMERCE_VERSION);
        $runLocalTests = 'sh ./vendor/wpdesk/wp-codeception/scripts/run_local_tests.sh ' . $singleTest . ' ' . $wooVersion;
        $this->execAndOutput($runLocalTests, $output);
    }
}
