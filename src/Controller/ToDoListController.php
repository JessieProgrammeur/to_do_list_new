<?php
    namespace App\Controller;

    use App\Entity\Todolist;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  
    class ToDoListController extends AbstractController {
        /**
         * @Route("/")
         * @Method({"GET"})
         */
        public function index() {

            $lists = $this->getDoctrine()->getRepository(ToDoList::Class)->findAll();

            return $this->render('list/index.html.twig', array('lists' => $lists));
        }

        /**
         * @Route("/list/{id}")
         */
        public function show($id) {
            $lists = $this->getDoctrine()->getRepository(ToDolist::Class)->find($id);

            return $this->render('list/show.html.twig', array('lists' => $lists));
        }

        // /**
        //  * @Route("/list/save")
        //  */
        // public function save() {
        //     $entityManager = $this->getDoctrine()->getManager();

        //     $todolist = new Todolist();
        //     $todolist->setTitle('Task One');
        //     $todolist->setBody('This is the body of task one');

        //     $entityManager->persist($todolist);

        //     $entityManager->flush();

        //     return new Response('Saved an task with the id of'. $todolist->getId());
        // }
    }