<?php

namespace NasaBundle\Controller;

use Doctrine\ORM\EntityManager;
use NasaBundle\ApiBridge\ApiClient;
use NasaBundle\Entity\NeoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NeoController
 * @package NasaBundle\Controller
 * @Route("/neo", name="neo")
 */
class NeoController extends Controller
{
    /**
     * @Route("/hazardous", name="hazardous")
     * @return JsonResponse
     * @throws \Exception
     */
    public function hazardousAction()
    {
        /**
         * @var $em EntityManager
         * @var $neoRepository NeoRepository
         * @var $api ApiClient
         */
        $em = $this->getDoctrine()->getEntityManager();

        try{
            $neoRepository = $em->getRepository('NasaBundle:Neo');

            $result = $neoRepository->getNeosObjects();

            return new JsonResponse($result, 200, ['Content-Type' => 'application/json']);

        } catch(\Exception $e){

            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @Route("/fastest", name="fastest")
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function fastestAction(Request $request)
    {
        /**
         * @var $em EntityManager
         * @var $neoRepository NeoRepository
         */
        //  get params
        $isHazardousParam = $request->query->get('hazardous', false);
        $isHazardous = $isHazardousParam && $isHazardousParam == 'true' ? true : false;

        $em = $this->getDoctrine()->getEntityManager();

        try{
            //  get instance of 'Neo' repository class
            $neoRepository = $em->getRepository('NasaBundle:Neo');
            //  get model of fastest Object from NEOs
            $result = $neoRepository->getFastestObject($isHazardous);

            return new JsonResponse($result, 200, ['Content-Type' => 'application-json']);

        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @Route("/best-year", name="best-year")
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function bestYearAction(Request $request)
    {
        /**
         * @var $em EntityManager
         * @var $neoRepository NeoRepository
         */
        $isHazardousParam = $request->query->get('hazardous', false);
        $isHazardous = $isHazardousParam && $isHazardousParam == 'true' ? true : false;

        $em = $this->getDoctrine()->getEntityManager();

        try{
            $neoRepository = $em->getRepository('NasaBundle:Neo');
            $result = $neoRepository->getBestYear($isHazardous);

            return new JsonResponse($result, 200, ['Content-Type' => 'application-json']);

        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @Route("best-month")
     * @Method("GET")
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function bestMonthAction(Request $request)
    {
        /**
         * @var $em EntityManager
         * @var $neoRepository NeoRepository
         */
        $isHazardousParam = $request->query->get('hazardous', false);
        $isHazardous = $isHazardousParam && $isHazardousParam == 'true' ? true : false;

        $em = $this->getDoctrine()->getEntityManager();

        try{
            $neoRepository = $em->getRepository('NasaBundle:Neo');
            $result = $neoRepository->getBestMonth($isHazardous);

            return new JsonResponse($result, 200, ['Content-Type' => 'application-json']);

        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

}
