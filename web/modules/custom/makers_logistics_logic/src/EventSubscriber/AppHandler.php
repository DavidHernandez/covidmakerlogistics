<?php

namespace Drupal\makers_logistics_logic\EventSubscriber;

use Drupal\discoverable_entity_bundle_classes\Storage\Comment\CommentStorage;
use Drupal\discoverable_entity_bundle_classes\Storage\SqlContentEntityStorageBase;
use Drupal\hook_event_dispatcher\Event\Views\ViewsPostExecuteEvent;
use Drupal\discoverable_entity_bundle_classes\Storage\Node\NodeStorage;
use Drupal\discoverable_entity_bundle_classes\Storage\Taxonomy\TermStorage;
use Drupal\hook_event_dispatcher\Event\EntityType\EntityTypeAlterEvent;
use Drupal\hook_event_dispatcher\HookEventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AppHandler.
 */
class AppHandler implements EventSubscriberInterface {

  /**
   * Constructs a new AppHandler object.
   */
  public function __construct() {

  }

  /**
   * @param EntityTypeAlterEvent $event
   *
   * @var \Drupal\Core\Entity\EntityTypeInterface[] $entity_types
   */
  public function enableDiscoverableEntityBundle(EntityTypeAlterEvent $event)
  {

    $entityTypes = $event->getEntityTypes();

    if (isset($entityTypes['node'])) {
      $entityTypes['node']->setStorageClass(NodeStorage::class);
    }

    if (isset($entityTypes['taxonomy_term'])) {
      $entityTypes['taxonomy_term']->setStorageClass(TermStorage::class);
    }

    if (isset($entityTypes['block_content'])) {
      $entityTypes['block_content']->setStorageClass(SqlContentEntityStorageBase::class);
    }

    if (isset($entityTypes['comment'])) {
      $entityTypes['comment']->setStorageClass(CommentStorage::class);
    }

  }


  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {

    return [
      HookEventDispatcherInterface::ENTITY_TYPE_ALTER => 'enableDiscoverableEntityBundle',
    ];

  }

}
