<?php

namespace Drupal\makers_logistics_logic\EventSubscriber;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Form\FormBase;
use Drupal\discoverable_entity_bundle_classes\Storage\Comment\CommentStorage;
use Drupal\discoverable_entity_bundle_classes\Storage\SqlContentEntityStorageBase;
use Drupal\hook_event_dispatcher\Event\Entity\EntityPresaveEvent;
use Drupal\hook_event_dispatcher\Event\Form\FormAlterEvent;
use Drupal\hook_event_dispatcher\Event\Views\ViewsPostExecuteEvent;
use Drupal\discoverable_entity_bundle_classes\Storage\Node\NodeStorage;
use Drupal\discoverable_entity_bundle_classes\Storage\Taxonomy\TermStorage;
use Drupal\hook_event_dispatcher\Event\EntityType\EntityTypeAlterEvent;
use Drupal\hook_event_dispatcher\HookEventDispatcherInterface;
use Drupal\makers_logistics_logic\Entity\CalculatedLabelInterface;
use Drupal\makers_logistics_logic\Entity\PickupRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class PickupRequestManager.
 */
class PickupRequestManager implements EventSubscriberInterface {


  public function manageEntityStatus(EntityPresaveEvent $event) {
    $entity = $event->getEntity();

    if ($entity instanceof PickupRequest && $entity->isNew()) {
      $entity->markAsPending();
    }
  }


  public function manageStatusFormField(FormAlterEvent $event)
  {
    $form = $event->getForm();
    if ($form['#form_id'] == 'node_pickup_request_form') {
      $this->hideStatusFormField($form);
    }

    $event->setForm($form);
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {

    return [
      HookEventDispatcherInterface::ENTITY_PRE_SAVE => 'manageEntityStatus',
      HookEventDispatcherInterface::FORM_ALTER => 'manageStatusFormField'
    ];

  }

  private function hideStatusFormField(&$form)
  {
    $form['field_status']['#access'] = false;
  }

}
