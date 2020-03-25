<?php
namespace Drupal\makers_logistics_logic\Entity;

use Drupal\discoverable_entity_bundle_classes\ContentEntityBundleInterface;
use Drupal\makers_logistics_logic\Service\StatusService;

/**
 * Class News. Represents the News Node bundle.
 *
 * @ContentEntityBundleClass(
 *   label = @Translation("Pickup requests"),
 *   entity_type = "node",
 *   bundle = "pickup_request"
 * );
 */
class PickupRequest extends \Drupal\node\Entity\Node implements ContentEntityBundleInterface, CalculatedLabelInterface
{

  const BUNDLE_NAME = 'pickup_request';

  public function getCalculatedLabel(): string
  {
    $author = $this->uid->entity;

    $address = $author->field_address->getValue();
    $address = current($address);

    $materials = $this->field_material->referencedEntities();

    $count = \Drupal::entityQuery('node')
      ->condition('type', self::BUNDLE_NAME)
      ->count()
      ->execute();

    $materialsString = sprintf('[%s]', implode(' - ', array_map(function($material) {
      return sprintf('%d %s', $material->field_quantity->value, $material->field_product->entity->getName());
    }, $materials)));

    return sprintf('#%d - %d %s', $count, $address['postal_code'], $materialsString);
  }

  public function markAsPending() {
    $pendingTerm = StatusService::getPending();

    $this->field_status->target_id = $pendingTerm->id();
  }

  public function markAsProcessing() {
    $pendingTerm = StatusService::getProcessing();

    $this->field_status->target_id = $pendingTerm->id();
  }
}
