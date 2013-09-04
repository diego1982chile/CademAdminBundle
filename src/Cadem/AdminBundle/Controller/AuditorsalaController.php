<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        // $em = $this->getDoctrine()->getManager();

        // $entities = $em->getRepository('CademAdminBundle:Auditorsala')->findAll();
		
		$entity = new Auditorsala();
        $form   = $this->createForm(new AuditorsalaType(), $entity);

        return $this->render('CademAdminBundle:Auditorsala:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));

        // return $this->render('CademAdminBundle:Auditorsala:index.html.twig', array(
            // 'entities' => $entities,
        // ));
    }
			 
	  /**
	   * @Route("/body", name="body")
	   * @Template()
	   */
	  public function body(Request $request)
	  {
		$get = $request->query->all();
	 
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		$columns = array( 'id', 'twitter_username', 'twitterID', 'firstname' );
		$get['columns'] = &$columns;
	 
		$em = $this->getDoctrine()->getEntityManager();
		$rResult = $em->getRepository('UserBundle:User')->ajaxTable($get, true)->getArrayResult();
	 
		/* Data set length after filtering */
		$iFilteredTotal = count($rResult);
	 
		/*
		 * Output
		 */
		$output = array(
		  "sEcho" => intval($get['sEcho']),
		  "iTotalRecords" => $em->getRepository('UserBundle:User')->getCount(),
		  "iTotalDisplayRecords" => $iFilteredTotal,
		  "aaData" => array()
		);
	 
		foreach($rResult as $aRow)
		{
		  $row = array();
		  for ( $i=0 ; $i<count($columns) ; $i++ ){
			if ( $columns[$i] == "version" ){
			  /* Special output formatting for 'version' column */
			  $row[] = ($aRow[ $columns[$i] ]=="0") ? '-' : $aRow[ $columns[$i] ];
			}elseif ( $columns[$i] != ' ' ){
			  /* General output */
			  $row[] = $aRow[ $columns[$i] ];
			}
		  }
		  $output['aaData'][] = $row;
		}
	 
		unset($rResult);
	 
		return new Response(
		  json_encode($output)
		);
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
