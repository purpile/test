<?php

namespace App\Controller;

use App\Entity\Devices;
use App\Form\DeviceType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends FOSRestController
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {

        $this->entityManager = $entityManager;
    }

    /**
     * @Route("", name="default")
     */
    public function index(Request $request) {

        $devices = $this->entityManager->getRepository(Devices::class)->findBy(['status' => 1]);

        $form = $this->createForm(DeviceType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $form->getData()->setStatus(0);
            $this->entityManager->persist($form->getData());
            $this->entityManager->flush();
            $mail = $this->get('app.mail');
            $mail->sendMailToAdmin();
            return $this->redirectToRoute('default');
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'devices' => $devices
        ]);
    }

    /**
     * @Rest\GET("device/list", name="api_list")
     */
    public function deviceList() {

        $devices = $this->entityManager->getRepository(Devices::class)->findBy(['status' => 0]);

        return $this->render('default/devices.html.twig', [
            'devices' => $devices
        ]);
    }

    /**
     * @Rest\Put("device/accept", name="api_accept")
     */
    public function addDevice(Request $request) {

        $device = $this->entityManager->getRepository(Devices::class)->find($request->get('data'));
        $device->setStatus(1);
        $this->entityManager->flush();

        return new JsonResponse('Success', 200);
    }

    /**
     * @Rest\Delete("device/delete", name="api_decline")
     */
    public function deleteDevice(Request $request) {

        $device = $this->entityManager->getRepository(Devices::class)->find($request->get('data'));
        $this->entityManager->remove($device);
        $this->entityManager->flush();

        return new JsonResponse('Success', 200);
    }

}
