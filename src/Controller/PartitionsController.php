<?php

namespace App\Controller;

use App\Entity\Partitions;
use App\Form\PartitionsType;
use App\Repository\PartitionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartitionsController extends AbstractController
{
    #[Route('/partitions', name: 'app_partitions')]
    public function index(PartitionsRepository $repository): Response
    {
        $partitions = $repository->findAll(); 
        return $this->render('pages/partitions/index.html.twig', [
            'partitions' => $partitions,
        ]);
    }

    #[Route('/partitions/new', name: 'partitions.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $partitions = new Partitions();
        $form = $this->createForm(PartitionsType::class, $partitions);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $partitions = $form->getData();
            $manager->persist($partitions);
            $manager->flush();

            return $this->redirectToRoute('app_partitions');
        }

        return $this->render('pages/partitions/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/partitions/edit/{id}', name: 'partitions.edit', methods: ['GET', 'POST'])]
    public function edit(PartitionsRepository $repository, Request $request, int $id, EntityManagerInterface $manager)
    {
        $partitions = $repository->findOneBy(["id" => $id]);
        $form = $this->createForm(PartitionsType::class, $partitions);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $partitions = $form->getData();

            $manager->persist($partitions);
            $manager->flush();

            return $this->redirectToRoute('app_partitions');
        }

        return $this->render('pages/partitions/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/partitions/delete/{id}', name:'partitions.delete', methods:['GET'])]
    public function delete(EntityManagerInterface $manager, PartitionsRepository $repository, int $id): Response
    {

        $partitions = $repository->findOneBy(["id" => $id]);

        if(!$partitions) {
            $this->addFlash(
                'success',
                'L\'ingredient n\'a pas ete trouvé'
            );

            return $this->redirectToRoute('partitions_index');
        }

        $manager->remove($partitions);
        $manager->flush();

        return $this->redirectToRoute('app_partitions');
    }

    #[Route('/partitions/{id}', name: 'partitions.show', methods: ['GET'])]
    public function show(int $id, PartitionsRepository $repository): Response
    {
        $partitions = $repository->findOneBy(['id' => $id]);
        return $this->render('pages/partitions/show.html.twig', [
            'partitions' => $partitions
        ]);
    }
}
