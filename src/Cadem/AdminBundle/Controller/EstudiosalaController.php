<?php

namespace Cadem\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Cadem\AdminBundle\Entity\Estudiosala;
use Cadem\AdminBundle\Form\EstudiosalaType;

use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

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
		
		$query = $em->createQuery(
			'SELECT e FROM CademAdminBundle:Estudio e');
			
		$estudios_ = $query->getResult();			
		
		// Obtener los estudios
		$head=array();		
		$estudios_aux=array();		
		
		// Generamos el head de la tabla, y los estudios
		foreach($estudios_ as $estudio)
		{
			if(!in_array($estudio->getNombre(),$head))
			{
				array_push($head,$estudio->getNombre());				
				$fila['id']=$estudio->getId();
				$fila['nombre']=$estudio->getNombre();
				array_push($estudios_aux,$fila);
			}		
		}							
		// Ordenamos la estructura usando comparador personalizado
		usort($estudios_aux, array($this,"sortFunction"));		
		
		// CONSTRUIR EL ENCABEZADO DE LA TABLA
		$aoColumnDefs=array();
		$prefixes=array('Folio','Cadena','Canal','Dirección','Comuna');				
		$cont=0;
		
		foreach($prefixes as $prefix)
		{						
			$fila=array();
			$fila['aTargets']=array($cont);		
			$fila['sTitle']=$prefix;
			switch($prefix)
			{
				case 'Folio':
					$fila['sWidth']="100px";
					break;
				case 'Cadena':
					$fila['sWidth']="150px";
					break;
				case 'Canal':
					$fila['sWidth']="150px";
					break;		
				case 'Dirección':
					$fila['sWidth']="200px";
					break;			
				case 'Comuna':
					$fila['sWidth']="150px";
					break;					
			}			
			// $fila['sWidth']="3%";
			array_push($aoColumnDefs,$fila);
			$cont++;					
		}
				
		$estudios=array();		
		
		foreach($estudios_aux as $estudio)
		{			
			array_push($estudios,$estudio['id']);				
			$fila=array();
			$fila['aTargets']=array($cont);		
			$fila['sTitle']=$estudio['nombre'];
			$fila['sClass']='columna';
			$fila['bSortable']=false;			
			$fila['sWidth']="30px";
			array_push($aoColumnDefs,$fila);
			$cont++;					
		}					
				
        // $entities = $em->getRepository('CademAdminBundle:Auditorsala')->findAll();
		
		$session = $this->get("session");
		$session->set("estudios",$estudios);								
		
		// Calcula el ancho máximo de la tabla	
		$extension=(5+count($head))*10-100;
		
		$max_width=100+$extension;	
		
		unset($estudios_aux);
		unset($head);
	
		if($extension<0)
			$extension=0;					
		
		$entity = new Estudiosala();
        $form   = $this->createForm(new EstudiosalaType(), $entity);			

        return $this->render('CademAdminBundle:Estudiosala:index.html.twig', array(
            // 'entity' => $entity,
            'form'   => $form->createView(),
			'aoColumnDefs' => json_encode($aoColumnDefs),	
			'max_width' => $max_width,
        ));
    }
	
	// Definimos un comparador de cadenas para ordenar los estudios
	function sortFunction( $a, $b ) {		
		return $a['nombre'] > $b['nombre'];
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
									   array('cad','nombre','s2'),
									   array('can','nombre','s3'),
									   array('s','calle','s0'),									   									   									  
									   array('com','nombre','s4'),
									   array('s','numerocalle','s0'),
									   array('s','id','s0'),									   									  
									   array('ests','id','s1'),	
									   array('e','id','s5'),									   									  
									   // array('auds','auditorid','s0'),									
									);
		
		// Se deben recuperar datos de las tablas: auditorsala (s0), sala (s1), cadena (s2), canal (s3), comuna (s4)
		
		$columns_=array(  's1_id', 's0_foliocadem', 's1_nombre', 's2_nombre','s0_calle', 's0_numerocalle', 's3_nombre','s5_id','s0_id' );
		$get['columns'] = &$columns;
	 
		$em = $this->getDoctrine()->getEntityManager();
		$rResult = $em->getRepository('CademAdminBundle:Estudiosala')->ajaxTable($get, true)->getArrayResult();
	 
		/* Data set length after filtering */
		$iFilteredTotal = count($rResult);			
	 
		/*
		 * Output
		 */
		$output = array(
		  "sEcho" => intval($get['sEcho']),
		  "iTotalRecords" => $em->getRepository('CademAdminBundle:Estudiosala')->getCount(),
		  "iTotalDisplayRecords" => $iFilteredTotal,
		  "aaData" => array()
		);
	 		
		$output['aaData'] = $this->get('cadem_admin.helper.data_hydrator')->hydrateEstudiosala($rResult,$session->get("estudios"));										
	 
		unset($rResult);
	 
		return new Response(
		  json_encode($output)
		);
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

            // return $this->redirect($this->generateUrl('estudiosala_show', array('id' => $entity->getId())));
			return new JsonResponse(array("status"=>true,"id"=>$entity->getId()));
        }
		
		return new JsonResponse(array("status"=>false,"id"=>''));

        // return $this->render('CademAdminBundle:Estudiosala:new.html.twig', array(
            // 'entity' => $entity,
            // 'form'   => $form->createView(),
        // ));
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

        // if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CademAdminBundle:Estudiosala')->find($id);

            if (!$entity) {
                // throw $this->createNotFoundException('Unable to find Estudiosala entity.');
				return new JsonResponse(array("status"=>false,"id"=>'',"Mensaje"=>"Unable to find Estudiosala entity"));
            }

            $em->remove($entity);
            $em->flush();
        // }
		return new JsonResponse(array("status"=>true,"id"=>''));
        // return $this->redirect($this->generateUrl('estudiosala'));
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
