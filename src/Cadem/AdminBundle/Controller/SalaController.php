<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cadem\AdminBundle\Entity\Sala;
use Cadem\AdminBundle\Form\SalaType;

/**
 * Sala controller.
 *
 */
class SalaController extends Controller
{
    /**
     * Lists all Sala entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CademAdminBundle:Sala')->findAll();

        return $this->render('CademAdminBundle:Sala:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Sala entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Sala();
        $form = $this->createForm(new SalaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sala_show', array('id' => $entity->getId())));
        }

        return $this->render('CademAdminBundle:Sala:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Sala entity.
     *
     */
    public function newAction()
    {
        $entity = new Sala();
        $form   = $this->createForm(new SalaType(), $entity);

        return $this->render('CademAdminBundle:Sala:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sala entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Sala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Sala:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Sala entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Sala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sala entity.');
        }

        $editForm = $this->createForm(new SalaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Sala:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Sala entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Sala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SalaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sala_edit', array('id' => $id)));
        }

        return $this->render('CademAdminBundle:Sala:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Sala entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CademAdminBundle:Sala')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sala entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sala'));
    }

    /**
     * Creates a form to delete a Sala entity by id.
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
