<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Cadem\AdminBundle\Entity\Auditorsala;
use Cadem\AdminBundle\Form\AuditorsalaType;

use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

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

        // $entities = $em->getRepository('CademAdminBundle:Auditorsala')->findAll();
		
		$session = $this->get("session");
		
		$entity = new Auditorsala();
        $form   = $this->createForm(new AuditorsalaType(), $entity);
		
		//auditores
		$query = $em->createQuery(
			'SELECT a FROM CademAdminBundle:Auditor a');
			
		$auditores = $query->getResult();				
		
		$choices_auditores = array('0' => '');
		foreach($auditores as $a)
		{
			$choices_auditores[$a->getId()] = strtoupper($a->getNombre());
		}
		
		$session->set("auditores",$choices_auditores);			

        return $this->render('CademAdminBundle:Auditorsala:index.html.twig', array(
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
	  public function bodyAction(Request $request)
	  {
		$get = $request->query->all();
		$session=$this->get("session");			
	 
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		// Se envían tripletas (alias,campo,alias_tabla)
		$columns = array( array('auds','auditorid','s0'),									   
									   array('s','foliocadem','s1'),
									   array('cad','nombre','s2'),
									   array('can','nombre','s3'),
									   array('s','calle','s1'),
									   array('s','numerocalle','s1'),									   									   
									   array('com','nombre','s4'),
									   array('s','id','s1'),									   									  
									);
		
		// Se deben recuperar datos de las tablas: auditorsala (s0), sala (s1), cadena (s2), canal (s3), comuna (s4)
		
		$columns_=array( 's0_auditorid', 's1_id', 's1_foliocadem', 's2_nombre', 's3_nombre','s1_calle', 's1_numerocalle', 's4_nombre' );
		$get['columns'] = &$columns;
	 
		$em = $this->getDoctrine()->getEntityManager();
		$rResult = $em->getRepository('CademAdminBundle:Auditorsala')->ajaxTable($get, true)->getArrayResult();
	 
		/* Data set length after filtering */
		$iFilteredTotal = count($rResult);			
	 
		/*
		 * Output
		 */
		$output = array(
		  "sEcho" => intval($get['sEcho']),
		  "iTotalRecords" => $em->getRepository('CademAdminBundle:Auditorsala')->getCount(),
		  "iTotalDisplayRecords" => $iFilteredTotal,
		  "aaData" => array()
		);
	 
		foreach($rResult as $aRow)
		{
		  $row = array();		  
		  for ( $i=0 ; $i<count($columns_) ; $i++ ){		  
			switch($columns_[$i])
			{
				case "version":
					$row[] = ($aRow[ $columns_[$i] ]=="0") ? '-' : $aRow[ $columns_[$i] ];
					break;
				case "s0_auditorid":
					$row[] = $this->get('cadem_admin.helper.controls_builder')->buildSelectAuditorsala($session->get("auditores"),array('id_auditor'=>$aRow['s0_auditorid'],'id_sala'=>$aRow['s1_id']));										
					break;								
				case "s1_calle":
					$row[] = $aRow['s1_calle'].' '.$aRow['s1_numerocalle'];
					break;
				case "s1_id":					
				case "s1_numerocalle":					
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

            // return $this->redirect($this->generateUrl('auditorsala_show', array('id' => $entity->getId())));
			return new JsonResponse(array("status"=>true,"id"=>$entity->getId()));
        }
		
		return new JsonResponse(array("status"=>false,"id"=>''));

        // return $this->render('CademAdminBundle:Auditorsala:new.html.twig', array(
            // 'entity' => $entity,
            // 'form'  => $form->createView(),
        // ));
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

        // $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AuditorsalaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            // return $this->redirect($this->generateUrl('auditorsala_edit', array('id' => $id)));
			return new JsonResponse(array("status"=>true,"id"=>$entity->getId()));
        }
		return new JsonResponse(array("status"=>false,"id"=>''));
        // return $this->render('CademAdminBundle:Auditorsala:edit.html.twig', array(
            // 'entity'      => $entity,
            // 'edit_form'   => $editForm->createView(),
            // 'delete_form' => $deleteForm->createView(),
        // ));
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
