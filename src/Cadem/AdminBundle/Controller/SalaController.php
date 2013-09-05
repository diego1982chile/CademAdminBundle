<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Cadem\AdminBundle\Entity\Sala;
use Cadem\AdminBundle\Form\SalaType;

use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        // $em = $this->getDoctrine()->getManager();

        // $entities = $em->getRepository('CademAdminBundle:Sala')->findAll();
		
		$entity = new Sala();
        $form   = $this->createForm(new SalaType(), $entity);

        return $this->render('CademAdminBundle:Sala:index.html.twig', array(
            // 'entities' => $entities,
			'form'   => $form->createView(),
        ));
    }
	
	/**
	   * @Route("/body", name="body")
	   * @Template()
	   */
	  public function bodyAction(Request $request)
	  {
		$get = $request->query->all();
		$session=$this->get("session");			
	 
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		// Se envían tripletas (alias,campo,alias_tabla)
		$columns = array( array('s','foliocadem','s0'),
									   array('cad','nombre','s1'),
									   array('can','nombre','s2'),
									   array('s','calle','s0'),									   
									   array('com','nombre','s3'),
									   array('s','latitud','s0'),									   									  
									   array('s','longitud','s0'),												   
									   array('s','id','s0'),
									   array('s','activo','s0'),
									   array('s','numerocalle','s0'),									   									   
									);
		
		// Se deben recuperar datos de las tablas: auditorsala (s0), sala (s1), cadena (s2), canal (s3), comuna (s4)
		
		$columns_=array(  's0_foliocadem', 's1_nombre', 's2_nombre', 's0_calle', 's0_numerocalle', 's3_nombre', 's0_latitud', 's0_longitud' , 'activo', 'actions');
		$get['columns'] = &$columns;
	 
		$em = $this->getDoctrine()->getEntityManager();
		$rResult = $em->getRepository('CademAdminBundle:Sala')->ajaxTable($get, true)->getArrayResult();
	 
		/* Data set length after filtering */
		$iFilteredTotal = count($rResult);			
	 
		/*
		 * Output
		 */
		$output = array(
		  "sEcho" => intval($get['sEcho']),
		  "iTotalRecords" => $em->getRepository('CademAdminBundle:Sala')->getCount(),
		  "iTotalDisplayRecords" => $iFilteredTotal,
		  "aaData" => array()
		);
	 
		foreach($rResult as $aRow)
		{
		// die(print_r($aRow));
		  $row = array();		  
		  for ( $i=0 ; $i<count($columns_) ; $i++ ){		  
			switch($columns_[$i])
			{
				case "version":
					$row[] = ($aRow[ $columns_[$i] ]=="0") ? '-' : $aRow[ $columns_[$i] ];
					break;																
				case "s0_calle":
					$row[] = $aRow['s0_calle'].' '.$aRow['s0_numerocalle'];
					break;
				case "s0_numerocalle":									
					break;			
				case "activo":
					$row[] =($aRow['s0_activo']) ? "<input type='checkbox' sala='".$aRow['s0_id']."' checked />" : "<input type='checkbox' sala='".$aRow['s0_id']."' />";
					break;					
				case "actions":
					$row[] ="<ul><li><a href='".$this->generateUrl('sala_show', array( "id" => $aRow['s0_id']) )."'>show</a></li><li><a href='".$this->generateUrl('sala_edit', array( "id" => $aRow['s0_id']) )."'>edit</a></li></ul>";
					break;
				default:
					 $row[] = $aRow[ $columns_[$i] ];
					 break;
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
