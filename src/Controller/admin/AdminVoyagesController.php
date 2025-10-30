<?php
namespace App\Controller\admin;


use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminVoyagesController
 * @author maryam
 */
class AdminVoyagesController extends AbstractController {
    #[Route('/admin', name: 'admin.voyages')]
    public function index() : Response {
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render("admin/admin.voyages.html.twig", 
                ['visites' => $visites]);
    }
    /**
     * @var VisiteRepository
     */
    private $repository;
    
    /**
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository) {
        $this->repository = $repository;
    }
    
     #[Route('/admin/suppr/{id}', name: 'admin.voyage.suppr')]
    public function suppr(int $id) : Response {
        $visite = $this->repository->find($id);
        $this->repository->remove($visite);
        return $this->redirectToRoute('admin.voyages');
                
    }
    
}