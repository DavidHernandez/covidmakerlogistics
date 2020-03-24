<?php
namespace Drupal\makers_logistics_logic\Entity;

use Drupal\discoverable_entity_bundle_classes\ContentEntityBundleInterface;

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

  public function getCalculatedLabel(): string
  {
    return sprintf('Solicitud de recogida');
  }
}
