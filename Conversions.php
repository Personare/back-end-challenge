<?php

class Conversions
{
    private $from;
    private $to;
    private $value;
    private $quotation;

    /**
     * @return mixed
     */
    public function getQuotation()
    {
        return $this->quotation;
    }

    /**
     * @param mixed $quotation
     */
    public function setQuotation($quotation)
    {
        $this->quotation = $quotation;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}