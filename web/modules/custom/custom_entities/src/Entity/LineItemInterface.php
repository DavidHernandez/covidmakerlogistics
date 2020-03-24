<?php

namespace Drupal\custom_entities\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Line item entities.
 *
 * @ingroup custom_entities
 */
interface LineItemInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Line item name.
   *
   * @return string
   *   Name of the Line item.
   */
  public function getName();

  /**
   * Sets the Line item name.
   *
   * @param string $name
   *   The Line item name.
   *
   * @return \Drupal\custom_entities\Entity\LineItemInterface
   *   The called Line item entity.
   */
  public function setName($name);

  /**
   * Gets the Line item creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Line item.
   */
  public function getCreatedTime();

  /**
   * Sets the Line item creation timestamp.
   *
   * @param int $timestamp
   *   The Line item creation timestamp.
   *
   * @return \Drupal\custom_entities\Entity\LineItemInterface
   *   The called Line item entity.
   */
  public function setCreatedTime($timestamp);

}
