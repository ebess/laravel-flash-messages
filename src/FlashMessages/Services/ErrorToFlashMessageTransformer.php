<?php

namespace Ebess\FlashMessages\Services;


class ErrorToFlashMessageTransformer
{
    /**
     * @param FlashMessages $flashMessages
     * @return mixed
     */
    public function transform(FlashMessages $flashMessages)
    {
        if (session()->has('errors')) {
            foreach (session('errors')->all() as $messages) {
                $flashMessages->add('danger', $messages);
            }
        }

        session()->forget('errors');
    }
}
