<?php
    namespace App\Controller;

    use App\Entity\Todolist;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
         * @Route("/list/new", name="task_list")
         * Method({"GET", "POST"})
         */
        public function new(Request $request) {
            $todolist = new ToDoList();

            $form = $this->createFormBuilder($todolist)
        ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('body', TextareaType::class, array(
          'required' => false,
          'attr' => array('class' => 'form-control')
        ))
        ->add('save', SubmitType::class, array(
          'label' => 'Create',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_list');
        }

            return $this->render('list/new.html.twig', array(
                'form' => $form->createView()
            ));
        }

        /**
         * @Route("/list/{id}")
         */
        public function show($id) {
            $lists = $this->getDoctrine()->getRepository(ToDolist::Class)->find($id);

            return $this->render('list/show.html.twig', array('lists' => $lists));
        }

        /**
         * @Route("list/delete/{id}")
         * @Method({"DELETE"})
         */
        public function delete(Request $request, $id) {
            $lists = $this->getDoctrine()->getRepository
            (ToDoList::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lists);
            $entityManager->flush();

            $response = new Response();
            $response->send();
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