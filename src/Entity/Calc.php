<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Calc
{
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "Base concentrate should be {{ limit }} or more.",
     *     maxMessage = "Base concentrate should be {{ limit }} or less.",
     * )
     */
    protected $cb;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "Nicotine (booster) concentrate should be {{ limit }} or more.",
     *     maxMessage = "Nicotine (booster) concentrate should be {{ limit }} or less.",
     * )
     */
    protected $cn;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "Needed concentrate should be {{ limit }} or more.",
     *     maxMessage = "Needed concentrate should be {{ limit }} or less.",
     * )
     */
    protected $cv;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100000,
     *     minMessage = "Needed volume should be {{ limit }} or more.",
     * )
     */
    protected $Vv;
    protected $Vn;
    protected $Vb;

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

    public function getVn($Vv,$cv,$cb,$cn)
    {
        return $this->Vn = ($Vv*($cv-$cb))/($cn-$cb);
    }

    public function getVb($Vv,$cv,$cb,$cn)
    {
        return $this->Vb = ($Vv*($cv-$cn))/($cb-$cn);
    }

}