<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cadem\AdminBundle\Entity\Estudio;
use Cadem\AdminBundle\Form\EstudioType;

use Symfony\Component\Intl\Intl;

\Locale::setDefault('es');

/**
 * Estudio controller.
 *
 */
class EstudioController extends Controller
{
    /**
     * Lists all Estudio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CademAdminBundle:Estudio')->findAll();

        return $this->render('CademAdminBundle:Estudio:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Estudio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Estudio();
        $form = $this->createForm(new EstudioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('estudio_show', array('id' => $entity->getId())));
        }

        return $this->render('CademAdminBundle:Estudio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Estudio entity.
     *
     */
    public function newAction()
    {
        $entity = new Estudio();
        $form   = $this->createForm(new EstudioType(), $entity);

        return $this->render('CademAdminBundle:Estudio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Estudio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Estudio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Estudio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Estudio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Estudio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudio entity.');
        }

        $editForm = $this->createForm(new EstudioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Estudio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Estudio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Estudio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EstudioType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('estudio_edit', array('id' => $id)));
        }

        return $this->render('CademAdminBundle:Estudio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Estudio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CademAdminBundle:Estudio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Estudio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('estudio'));
    }

    /**
     * Creates a form to delete a Estudio entity by id.
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
