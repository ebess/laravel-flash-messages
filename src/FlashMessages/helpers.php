<?php

if (! function_exists('flash')) {
    /**
     * @return Ebess\FlashMessages\Services\FlashMessages
     */
    function flash()
    {
        return app(Ebess\FlashMessages\Services\FlashMessages::class);
    }
}
