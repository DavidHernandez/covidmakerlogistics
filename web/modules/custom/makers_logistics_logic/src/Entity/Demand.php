<?php
namespace Drupal\makers_logistics_logic\Entity;

use Drupal\discoverable_entity_bundle_classes\ContentEntityBundleInterface;

/**
 * Class News. Represents the News Node bundle.
 *
 * @ContentEntityBundleClass(
 *   label = @Translation("Demand"),
 *   entity_type = "node",
 *   bundle = "demand"
 * );
 */
class Demand extends \Drupal\node\Entity\Node implements ContentEntityBundleInterface, CalculatedLabelInterface
{

  public function getCalculatedLabel(): string
  {
    return sprintf('Demanda de material');
  }
}
