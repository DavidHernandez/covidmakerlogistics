<?php

namespace Drupal\makers_logistics_logic\EventSubscriber;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\discoverable_entity_bundle_classes\Storage\Comment\CommentStorage;
use Drupal\discoverable_entity_bundle_classes\Storage\SqlContentEntityStorageBase;
use Drupal\hook_event_dispatcher\Event\Entity\EntityPresaveEvent;
use Drupal\hook_event_dispatcher\Event\Views\ViewsPostExecuteEvent;
use Drupal\discoverable_entity_bundle_classes\Storage\Node\NodeStorage;
use Drupal\discoverable_entity_bundle_classes\Storage\Taxonomy\TermStorage;
use Drupal\hook_event_dispatcher\Event\EntityType\EntityTypeAlterEvent;
use Drupal\hook_event_dispatcher\HookEventDispatcherInterface;
use Drupal\makers_logistics_logic\Entity\CalculatedLabelInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class LabelCalculationManager.
 */
class LabelCalculationManager implements EventSubscriberInterface {


  public function updateLabelIfNeeded(EntityPresaveEvent $event) {
    $entity = $event->getEntity();

    if ($entity instanceof ContentEntityBase && $entity instanceof CalculatedLabelInterface) {
      $entityType = $entity->getEntityType();

      $labelKey = $entityType->getKey('label');
      $entity->set($labelKey, $entity->getCalculatedLabel());

      $event->setEntity($entity);
    }
  }


  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {

    return [
      HookEventDispatcherInterface::ENTITY_PRE_SAVE => 'updateLabelIfNeeded',
    ];

  }

}
