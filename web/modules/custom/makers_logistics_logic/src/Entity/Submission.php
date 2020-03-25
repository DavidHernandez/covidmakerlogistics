<?php
namespace Drupal\makers_logistics_logic\Entity;

use Drupal\discoverable_entity_bundle_classes\ContentEntityBundleInterface;

/**
 * Class Submission. Represents the News Node bundle.
 *
 * @ContentEntityBundleClass(
 *   label = @Translation("Submission"),
 *   entity_type = "node",
 *   bundle = "submission"
 * );
 */
class Submission extends \Drupal\node\Entity\Node implements ContentEntityBundleInterface, CalculatedLabelInterface
{

  public function getCalculatedLabel(): string
  {
    return sprintf('Envio de material');
  }
}
