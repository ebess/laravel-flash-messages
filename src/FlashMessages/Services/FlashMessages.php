<?php

namespace Ebess\FlashMessages\Services;

use Illuminate\Support\MessageBag;
use Illuminate\Contracts\Support\MessageBag as MessageBagContract;

class FlashMessages
{
    /**
     * @var string
     */
    private $sessionKey;

    /**
     * @var ErrorToFlashMessageTransformer
     */
    private $transformer;

    /**
     * @param string $sessionKey
     */
    public function __construct($sessionKey, ErrorToFlashMessageTransformer $transformer = null)
    {
        $this->sessionKey = $sessionKey;
        $this->transformer = $transformer;
    }

    /**
     * @param string $type
     * @param string $text
     * @param null|string $title
     */
    public function add($type, $text, $title = null)
    {
        /** @var MessageBag $messageBag */
        $messageBag = session()->has($this->sessionKey) ? session($this->sessionKey) : new MessageBag;
        $messageBag->add($type, compact('title', 'text'));

        session()->flash($this->sessionKey, $messageBag);
    }

    /**
     * @return MessageBagContract|null
     */
    public function get()
    {
        if ($this->transformer) {
            $this->transformer->transform($this);
        }

        $messages = session($this->sessionKey)->getMessages();
        session()->forget($this->sessionKey);

        return $messages;
    }

    /**
     * @return bool
     */
    public function has()
    {
        return session()->has($this->sessionKey) && session($this->sessionKey)->count() > 0;
    }
}
