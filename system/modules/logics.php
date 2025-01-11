<?php

class Formula {
    public $formula_name = "";
    public $formula_text = "";
    public $formula_diff_coef = "";
    
    public function __construct($formula_name, $formula_text, $formula_diff_coef){
        $this->formula_name = $formula_name;
        $this->formula_text = $formula_text;
        $this->formula_diff_coef = $formula_diff_coef;
    }

    public function getF(){
        return [$this->formula_name, $this->formula_text, $this->formula_diff_coef];
    }
}

function changeF($formula_text, $difficulty)
{
    $formula_parts = explode(" ", $formula_text);
    // print_r($formula_parts);
    $result = implode(" ", $formula_parts);
    return $result;
}

?>