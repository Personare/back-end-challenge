<?php

require_once ("Conversions.php");

class ConversionsDao
{

    public function conversionsValue($from,$to,$value,$quotation){

        $conversions = new Conversions();
        $conversions->setFrom($from);
        $conversions->setTo($to);
        $conversions->setValue($value);
        $conversions->setQuotation($quotation);

        if($conversions->getFrom()=="BRL" && $conversions->getTo()=="USD"){
            return $this->conversionsRealDolar($conversions->getValue(),$conversions->getQuotation());
        }

        if($conversions->getFrom()=="USD" && $conversions->getTo()=="BRL"){
            return $this->conversionsDolarReal($conversions->getValue(),$conversions->getQuotation());
        }

        if($conversions->getFrom()=="BRL" && $conversions->getTo()=="EUR"){
            return $this->conversionsRealEuro($conversions->getValue(),$conversions->getQuotation());
        }
        if($conversions->getFrom()=="EUR" && $conversions->getTo()=="BRL"){
            return $this->conversionsEuroReal($conversions->getValue(),$conversions->getQuotation());
        }

    }

    private function conversionsRealDolar($value,$quotation){

        $preco_format=($value/$quotation);

        $value_return = number_format($preco_format, 2);

        $return = array();
        $return["moeda"] = "USD";
        $return["value"] = $value_return;
        return ($return);
    }

    private function conversionsDolarReal($value,$quotation){

        $preco_format=($value*$quotation);

        $value_return = number_format($preco_format, 2, ",", "");

        $return = array();
        $return["moeda"] = "BRL";
        $return["value"] = $value_return;
        return ($return);
    }

    private function conversionsRealEuro($value,$quotation){

        $preco_format=($value/$quotation);

        $value_return = number_format($preco_format, 2);

        $return = array();
        $return["moeda"] = "EUR";
        $return["value"] = $value_return;
        return ($return);
    }

    private function conversionsEuroReal($value,$quotation){

        $preco_format=($value*$quotation);

        $value_return = number_format($preco_format, 2, ",", "");

        $return = array();
        $return["moeda"] = "BRL";
        $return["value"] = $value_return;
        return ($return);
    }

}