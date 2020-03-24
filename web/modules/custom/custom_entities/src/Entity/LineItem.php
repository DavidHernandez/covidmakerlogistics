<?php

namespace Drupal\custom_entities\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Line item entity.
 *
 * @ingroup custom_entities
 *
 * @ContentEntityType(
 *   id = "line_item",
 *   label = @Translation("Line item"),
 *   bundle_label = @Translation("Line item type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\custom_entities\LineItemListBuilder",
 *     "views_data" = "Drupal\custom_entities\Entity\LineItemViewsData",
 *     "translation" = "Drupal\custom_entities\LineItemTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\custom_entities\Form\LineItemForm",
 *       "add" = "Drupal\custom_entities\Form\LineItemForm",
 *       "edit" = "Drupal\custom_entities\Form\LineItemForm",
 *       "delete" = "Drupal\custom_entities\Form\LineItemDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\custom_entities\LineItemHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\custom_entities\LineItemAccessControlHandler",
 *   },
 *   base_table = "line_item",
 *   data_table = "line_item_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer line item entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/line_item/{line_item}",
 *     "add-page" = "/admin/structure/line_item/add",
 *     "add-form" = "/admin/structure/line_item/add/{line_item_type}",
 *     "edit-form" = "/admin/structure/line_item/{line_item}/edit",
 *     "delete-form" = "/admin/structure/line_item/{line_item}/delete",
 *     "collection" = "/admin/structure/line_item",
 *   },
 *   bundle_entity_type = "line_item_type",
 *   field_ui_base_route = "entity.line_item_type.edit_form"
 * )
 */
class LineItem extends ContentEntityBase implements LineItemInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Line item entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['status']->setDescription(t('A boolean indicating whether the Line item is published.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
