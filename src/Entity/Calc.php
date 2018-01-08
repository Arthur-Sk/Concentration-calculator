<?php

namespace App\Entity;

class Calc
{
    protected $cb;
    protected $cn;
    protected $cv;
    protected $Vv;

    public function getCb()
    {
        return $this->cb;
    }

    public function setCb($cb)
    {
        $this->cb = $cb;
    }

    public function getCn()
    {
        return $this->cn;
    }

    public function setCn($cn)
    {
        $this->cn = $cn;
    }

    public function getCv()
    {
        return $this->cv;
    }

    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    public function getVv()
    {
        return $this->Vv;
    }

    public function setVv($Vv)
    {
        $this->Vv = $Vv;
    }

}