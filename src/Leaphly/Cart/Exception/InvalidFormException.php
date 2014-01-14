<?php

namespace Leaphly\Cart\Exception;

use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

/**
 * Base InvalidFormException for the Form component.
 *
 * @author Simone Di Maulo <toretto460@gmail.com>
 */
class InvalidFormException extends NotAcceptableHttpException implements ExceptionInterface
{
    /**
     * @var array|null
     */
    protected $form;

    /**
     * @param string     $message
     * @param array|null $form
     */
    public function __construct($message, $form = null)
    {
        parent::__construct($message);
        $this->form = $form;
    }

    /**
     * @return array|null
     */
    public function getForm()
    {
        return $this->form;
    }
}
