<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cadem\AdminBundle\Entity\Auditor;
use Cadem\AdminBundle\Form\AuditorType;

/**
 * Auditor controller.
 *
 */
class AuditorController extends Controller
{
    /**
     * Lists all Auditor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CademAdminBundle:Auditor')->findAll();

        return $this->render('CademAdminBundle:Auditor:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Auditor entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Auditor();
        $form = $this->createForm(new AuditorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('auditor_show', array('id' => $entity->getId())));
        }

        return $this->render('CademAdminBundle:Auditor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Auditor entity.
     *
     */
    public function newAction()
    {
        $entity = new Auditor();
        $form   = $this->createForm(new AuditorType(), $entity);

        return $this->render('CademAdminBundle:Auditor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Auditor entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Auditor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auditor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Auditor:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Auditor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Auditor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auditor entity.');
        }

        $editForm = $this->createForm(new AuditorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Auditor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Auditor entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Auditor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auditor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AuditorType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('auditor_edit', array('id' => $id)));
        }

        return $this->render('CademAdminBundle:Auditor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Auditor entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CademAdminBundle:Auditor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Auditor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('auditor'));
    }

    /**
     * Creates a form to delete a Auditor entity by id.
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
