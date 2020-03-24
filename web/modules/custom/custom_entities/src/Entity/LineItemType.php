<?php

namespace Drupal\custom_entities\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Line item type entity.
 *
 * @ConfigEntityType(
 *   id = "line_item_type",
 *   label = @Translation("Line item type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\custom_entities\LineItemTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\custom_entities\Form\LineItemTypeForm",
 *       "edit" = "Drupal\custom_entities\Form\LineItemTypeForm",
 *       "delete" = "Drupal\custom_entities\Form\LineItemTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\custom_entities\LineItemTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "line_item_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "line_item",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/line_item_type/{line_item_type}",
 *     "add-form" = "/admin/structure/line_item_type/add",
 *     "edit-form" = "/admin/structure/line_item_type/{line_item_type}/edit",
 *     "delete-form" = "/admin/structure/line_item_type/{line_item_type}/delete",
 *     "collection" = "/admin/structure/line_item_type"
 *   }
 * )
 */
class LineItemType extends ConfigEntityBundleBase implements LineItemTypeInterface {

  /**
   * The Line item type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Line item type label.
   *
   * @var string
   */
  protected $label;

}
