<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cadem\AdminBundle\Entity\Estudiosala;
use Cadem\AdminBundle\Form\EstudiosalaType;

/**
 * Estudiosala controller.
 *
 */
class EstudiosalaController extends Controller
{
    /**
     * Lists all Estudiosala entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CademAdminBundle:Estudiosala')->findAll();

        return $this->render('CademAdminBundle:Estudiosala:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Estudiosala entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Estudiosala();
        $form = $this->createForm(new EstudiosalaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('estudiosala_show', array('id' => $entity->getId())));
        }

        return $this->render('CademAdminBundle:Estudiosala:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Estudiosala entity.
     *
     */
    public function newAction()
    {
        $entity = new Estudiosala();
        $form   = $this->createForm(new EstudiosalaType(), $entity);

        return $this->render('CademAdminBundle:Estudiosala:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Estudiosala entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Estudiosala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudiosala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Estudiosala:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Estudiosala entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Estudiosala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudiosala entity.');
        }

        $editForm = $this->createForm(new EstudiosalaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Estudiosala:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Estudiosala entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Estudiosala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudiosala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EstudiosalaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('estudiosala_edit', array('id' => $id)));
        }

        return $this->render('CademAdminBundle:Estudiosala:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Estudiosala entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CademAdminBundle:Estudiosala')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Estudiosala entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('estudiosala'));
    }

    /**
     * Creates a form to delete a Estudiosala entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
