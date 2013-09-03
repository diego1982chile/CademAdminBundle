<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cadem\AdminBundle\Entity\Auditorsala;
use Cadem\AdminBundle\Form\AuditorsalaType;

/**
 * Auditorsala controller.
 *
 */
class AuditorsalaController extends Controller
{
    /**
     * Lists all Auditorsala entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CademAdminBundle:Auditorsala')->findAll();

        return $this->render('CademAdminBundle:Auditorsala:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Auditorsala entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Auditorsala();
        $form = $this->createForm(new AuditorsalaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('auditorsala_show', array('id' => $entity->getId())));
        }

        return $this->render('CademAdminBundle:Auditorsala:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Auditorsala entity.
     *
     */
    public function newAction()
    {
        $entity = new Auditorsala();
        $form   = $this->createForm(new AuditorsalaType(), $entity);

        return $this->render('CademAdminBundle:Auditorsala:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Auditorsala entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Auditorsala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auditorsala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Auditorsala:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Auditorsala entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Auditorsala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auditorsala entity.');
        }

        $editForm = $this->createForm(new AuditorsalaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Auditorsala:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Auditorsala entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Auditorsala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auditorsala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AuditorsalaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('auditorsala_edit', array('id' => $id)));
        }

        return $this->render('CademAdminBundle:Auditorsala:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Auditorsala entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CademAdminBundle:Auditorsala')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Auditorsala entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('auditorsala'));
    }

    /**
     * Creates a form to delete a Auditorsala entity by id.
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
