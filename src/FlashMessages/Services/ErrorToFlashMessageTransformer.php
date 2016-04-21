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
            foreach (session('errors')->getMessages() as $type => $messages) {
                foreach ($messages as $text) {
                    $flashMessages->add('danger', $text);
                }
            }
        }

        session()->forget('errors');
    }
}
