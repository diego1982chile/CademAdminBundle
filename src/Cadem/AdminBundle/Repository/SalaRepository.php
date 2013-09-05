<?php

namespace Cadem\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class SalaRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
                    ->createQuery("SELECT u FROM Cadem\AdminBundle\Entity\Sala s ORDER BY s.nombre ASC")
                    ->getResult();
    }
	
   /**
   * @param array $get
   * @param bool $flag
   * @return array|\Doctrine\ORM\Query
   */
   public function ajaxTable(array $get, $flag = false)
   {
    /* Indexed column (used for fast and accurate table cardinality) */
    $alias = 's';
 
    /* DB table to use */
    $tableObjectName = 'CademAdminBundle:Sala';
 
    /**
     * Set to default
     */
    if(!isset($get['columns']) || empty($get['columns']))
      $get['columns'] = array('id');
 
    $aColumns = array();
    
	foreach($get['columns'] as $value) 		
		$aColumns[] = $value[0].'.'.$value[1].' as '.$value[2].'_'.$value[1];								
 
    $cb = $this->getEntityManager()
      ->getRepository($tableObjectName)
      ->createQueryBuilder($alias)      
	  ->select(str_replace(" , ", " ", implode(", ", $aColumns)))	  	  
	  ->leftjoin('s.cadena','cad')
	  ->leftjoin('s.canal','can')
	  ->leftjoin('s.comuna','com');
 
    if ( isset( $get['iDisplayStart'] ) && $get['iDisplayLength'] != '-1' ){
      $cb->setFirstResult( (int)$get['iDisplayStart'] )
        ->setMaxResults( (int)$get['iDisplayLength'] );
    }
 
    /*
     * Ordering
     */
    if ( isset( $get['iSortCol_0'] ) ){
      for ( $i=0 ; $i<intval( $get['iSortingCols'] ) ; $i++ ){
        if ( $get[ 'bSortable_'.intval($get['iSortCol_'.$i]) ] == "true" ){
          // $cb->orderBy($aColumns[ (int)$get['iSortCol_'.$i] ], $get['sSortDir_'.$i]);
		  $cb->orderBy(explode('as',$aColumns[ (int)$get['iSortCol_'.$i] ])[0], $get['sSortDir_'.$i]);
        }
      }
    }
 
    /*
       * Filtering
       * NOTE this does not match the built-in DataTables filtering which does it
       * word by word on any field. It's possible to do here, but concerned about efficiency
       * on very large tables, and MySQL's regex functionality is very limited
       */
    if ( isset($get['sSearch']) && $get['sSearch'] != '' ){
      $aLike = array();
      for ( $i=0 ; $i<count($aColumns) ; $i++ ){
        if ( isset($get['bSearchable_'.$i]) && $get['bSearchable_'.$i] == "true" ){
          // $aLike[] = $cb->expr()->like($aColumns[$i], '\'%'. $get['sSearch'] .'%\'');
		  $aLike[] = $cb->expr()->like(explode('as',$aColumns[$i])[0], '\'%'. $get['sSearch'] .'%\'');
        }
      }
      if(count($aLike) > 0) $cb->andWhere(new Expr\Orx($aLike));
      else unset($aLike);
    }
 
    /*
     * SQL queries
     * Get data to display
     */
    $query = $cb->getQuery();
 
    if($flag)
      return $query;
    else
      return $query->getResult();
  }
  
  /**
   * @return int
   */
  public function getCount(){
    $aResultTotal = $this->getEntityManager()
      ->createQuery('SELECT COUNT(s) FROM CademAdminBundle:Sala s')
      ->setMaxResults(1)
      ->getResult();
     return $aResultTotal[0][1];
  }
}