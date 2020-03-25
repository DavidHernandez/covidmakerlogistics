<?php

namespace Drupal\makers_logistics_logic\EventSubscriber;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Form\FormBase;
use Drupal\discoverable_entity_bundle_classes\Storage\Comment\CommentStorage;
use Drupal\discoverable_entity_bundle_classes\Storage\SqlContentEntityStorageBase;
use Drupal\hook_event_dispatcher\Event\Entity\EntityInsertEvent;
use Drupal\hook_event_dispatcher\Event\Entity\EntityPresaveEvent;
use Drupal\hook_event_dispatcher\Event\Form\FormAlterEvent;
use Drupal\hook_event_dispatcher\Event\Views\ViewsPostExecuteEvent;
use Drupal\discoverable_entity_bundle_classes\Storage\Node\NodeStorage;
use Drupal\discoverable_entity_bundle_classes\Storage\Taxonomy\TermStorage;
use Drupal\hook_event_dispatcher\Event\EntityType\EntityTypeAlterEvent;
use Drupal\hook_event_dispatcher\HookEventDispatcherInterface;
use Drupal\makers_logistics_logic\Entity\CalculatedLabelInterface;
use Drupal\makers_logistics_logic\Entity\PickupRequest;
use Drupal\makers_logistics_logic\Entity\Submission;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class SubmissionManager.
 */
class SubmissionManager implements EventSubscriberInterface {


  public function managePickupsRequestsStatuses(EntityInsertEvent $event) {
    $entity = $event->getEntity();

    if ($entity instanceof Submission) {
      /** @var PickupRequest $pickupRequest */
      foreach($entity->field_pickup_requests->referencedEntities() as $pickupRequest) {
        $pickupRequest->markAsProcessing();
        $pickupRequest->save();
      }

      \Drupal::messenger()->addMessage('El estado de las solicitudes de recogida se ha cambiado a "En proceso"');
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {

    return [
      HookEventDispatcherInterface::ENTITY_INSERT => 'managePickupsRequestsStatuses',
    ];
  }

}
