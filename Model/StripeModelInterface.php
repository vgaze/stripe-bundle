<?php

namespace Aimir\StripeBundle\Model;

use Stripe\Object as StripeObject;

interface StripeModelInterface
{
    /**
     * Retrieve stripe object ID
     *
     * return string
     */
    public function getStripeId();

    /**
     * Get model metadata
     *
     * @return array
     */
    public function getMetadata();

    /**
     * Initialize model object from stripe data
     *
     * @param StripeObject $object
     * @return $this
     */
    public function initFromStripeObject(StripeObject $object);

    /**
     * Update model object from stripe data
     *
     * @param StripeObject $object
     * @return $this
     */
    public function updateFromStripeObject(StripeObject $object);
}
