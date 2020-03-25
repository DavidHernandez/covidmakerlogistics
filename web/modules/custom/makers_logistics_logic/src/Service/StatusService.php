<?php


namespace Drupal\makers_logistics_logic\Service;


use Drupal\taxonomy\Entity\Term;

class StatusService
{

  const PENDING_TID = 8;
  const PROCESSING_TID = 9;
  const COMPLETED_TID = 10;

  /**
   * @return \Drupal\Core\Entity\EntityInterface|Term|null
   */
  public static function getPending() {
    return Term::load(self::PENDING_TID);
  }

  /**
   * @return \Drupal\Core\Entity\EntityInterface|Term|null
   */
  public static function getProcessing() {
    return Term::load(self::PROCESSING_TID);
  }

  /**
   * @return \Drupal\Core\Entity\EntityInterface|Term|null
   */
  public static function getCompleted() {
    return Term::load(self::COMPLETED_TID);
  }

}
