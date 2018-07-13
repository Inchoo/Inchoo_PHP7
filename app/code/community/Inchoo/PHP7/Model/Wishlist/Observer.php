<?php

class Inchoo_PHP7_Model_Wishlist_Observer extends Mage_Wishlist_Model_Observer
{
    /**
     * Fixes: Warning: count(): Parameter must be an array or an object that implements Countable in app/code/core/Mage/Wishlist/Model/Observer.php on line 105
     * Fixes: Warning: count(): Parameter must be an array or an object that implements Countable in app/code/core/Mage/Wishlist/Model/Observer.php on line 128
     *
     * Original algorithm will be not touched and the price is that we will always store array for two variables in the session if they are not set, when this algorithm runs.
     * @param $observer
     */
    public function processAddToCart($observer)
    {
        $session = Mage::getSingleton('checkout/session');

        $urls = $session->getWishlistPendingUrls();
        if (!is_array($urls) && !($urls instanceof Countable) && !$urls) $session->setWishlistIds([]);

        $wishlistIds = $session->getWishlistIds();
        if (!is_array($wishlistIds) && !($wishlistIds instanceof Countable) && !$wishlistIds) $session->setWishlistPendingUrls([]);

        return parent::processAddToCart($observer);
    }
}