<?php

namespace Aimir\StripeBundle\Doctrine;

use Aimir\StripeBundle\ModelManager\ModelManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Stripe\Object as StripeObject;

class CustomerManager extends DoctrineManagerAbstract
{
    /**
     * @var ModelManagerInterface
     */
    protected $cardManager;

    /**
     * @var ModelManagerInterface
     */
    protected $subscriptionManager;

    /**
     * @param ModelManagerInterface $cardManager
     */
    public function setCardManager(ModelManagerInterface $cardManager)
    {
        $this->cardManager = $cardManager;
    }

    /**
     * @param ModelManagerInterface $subscriptionManager
     */
    public function setSubscriptionManager(ModelManagerInterface $subscriptionManager)
    {
        $this->subscriptionManager = $subscriptionManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(StripeObject $stripeObject, $flush = false)
    {
        $model = parent::save($stripeObject, $flush);
        if ($stripeObject['sources']['total_count'] > 0) {
            foreach ($stripeObject['sources']['data'] as $sourceObject) {
                $this->cardManager->save($sourceObject, $flush);
            }
        }
        if ($stripeObject['subscriptions']['total_count'] > 0) {
            foreach ($stripeObject['subscriptions']['data'] as $subscriptionObject) {
                $this->subscriptionManager->save($subscriptionObject, $flush);
            }
        }

        return $model;
    }
}
