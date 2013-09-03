<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Cadem\AdminBundle\Entity\Item;
use Cadem\AdminBundle\Form\ItemType;

/**
 * Item controller.
 *
 */
class ItemController extends Controller
{
    /**
     * Lists all Item entities.
     *
     */
    public function indexAction()
    {
        // $em = $this->getDoctrine()->getManager();

        // $entities = $em->getRepository('CademAdminBundle:Item')->findAll();

        // return $this->render('CademAdminBundle:Item:index.html.twig', array(
            // 'entities' => $entities,
        // ));
		return $this->render('CademAdminBundle:Item:index.html.twig', array());
    }
	
   /**
   * @Route("/body", name="item")
   * @Template()
   */
  public function bodyAction(Request $request)
  {
    $get = $request->query->all();
 
    /* Array of database columns which should be read and sent back to DataTables. Use a space where
    * you want to insert a non-database field (for example a counter or static image)
    */
    $columns = array( 'id', 'nombre', 'codigo', 'marca', 'fabricante', 'activo');	
    
	$get['columns'] = &$columns;
 
    $em = $this->getDoctrine()->getEntityManager();
	
	// $algo=$em->getRepository('CademAdminBundle:Item')->findAllOrderedByName();
	
	// print_r($algo[0]->getMarca()->getNombre());
	
    $rResult = $em->getRepository('CademAdminBundle:Item')->ajaxTable($get, true)->getArrayResult();
 
 
    /* Data set length after filtering */
    $iFilteredTotal = count($rResult);
 
    /*
     * Output
     */
    $output = array(
      "sEcho" => intval($get['sEcho']),
      "iTotalRecords" => $em->getRepository('CademAdminBundle:Item')->getCount(),
      "iTotalDisplayRecords" => $iFilteredTotal,
      "aaData" => array()
    );
 	
	
    foreach($rResult as $aRow)
    {
	  // die(print_r($aRow));
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
     * Creates a new Item entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Item();
        $form = $this->createForm(new ItemType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('item_show', array('id' => $entity->getId())));
        }

        return $this->render('CademAdminBundle:Item:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Item entity.
     *
     */
    public function newAction()
    {
        $entity = new Item();
        $form   = $this->createForm(new ItemType(), $entity);

        return $this->render('CademAdminBundle:Item:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Item entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Item:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Item entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $editForm = $this->createForm(new ItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CademAdminBundle:Item:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Item entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CademAdminBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ItemType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('item_edit', array('id' => $id)));
        }

        return $this->render('CademAdminBundle:Item:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Item entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CademAdminBundle:Item')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Item entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('item'));
    }

    /**
     * Creates a form to delete a Item entity by id.
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
