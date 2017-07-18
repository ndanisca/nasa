<?php


namespace NasaBundle\Command;

use Doctrine\ORM\EntityManager;
use NasaBundle\ApiBridge\ApiClient;
use NasaBundle\Entity\NeoRepository;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CountNEOCommand
 * @package NasaBundle\Command
 */
class CountNEOCommand extends Command
{
    const URL = 'rest/v1/feed';
    const DAYS = '2';

    // command configuration init
    // set command name
    // set command desc
    // set command arguments
    protected function configure()
    {
        $this->setName('neos:count')
              ->setDescription('Counts NEOs objects')
              ->addArgument('days', InputArgument::OPTIONAL, 'specify period in days');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var $api ApiClient
         * @var $app Application
         * @var $container ContainerInterface
         * @var $em EntityManager
         * @var $neoRepository NeoRepository
         */

        //  get command input arguments
        $days = $input->getArgument('days');

        //  get number of days
        $periodInDays = $days ? $days : self::DAYS;

        //  set dates of period
        // end_date (the whole current day)
        // start_date (end_date minus No in days)

        $endDate = (new \DateTime())->modify('tomorrow - 1 second');
        $startDate = (clone $endDate);
        $startDate->modify('-'.$periodInDays.' days');

        // prepare array parameters
        $params = ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')];

        //  init API bridge -> accomplish request to NASA API
        $api = new ApiClient();
        $response = $api->makeApiRequest(self::URL, $params);

        $app = $this->getApplication();
        $container = $app->getKernel()->getContainer();

        //  get entity manager object
        $em = $container->get('doctrine')->getManager();

        //  get link to repository object
        $neoRepository =  $em->getRepository("NasaBundle:Neo");

        //  counting Neos objects
        $count = $neoRepository->getCountNeos($response);

        //  persist data in table
        $result = $neoRepository->persistData($response);

        //  output the result
        $output->writeln('Total Neos count: '.$count);
    }
}