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
     *     minMessage = "This value should be {{ limit }} or more.",
     *     maxMessage = "This value should be {{ limit }} or less.",
     *     invalidMessage = "This value should be a valid number."
     * )
     */
    protected $cb;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "This value should be {{ limit }} or more.",
     *     maxMessage = "This value should be {{ limit }} or less.",
     *     invalidMessage = "This value should be a valid number."
     * )
     */
    protected $cn;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "This value should be {{ limit }} or more.",
     *     maxMessage = "This value should be {{ limit }} or less.",
     *     invalidMessage = "This value should be a valid number."
     * )
     */
    protected $cv;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     minMessage = "This value should be {{ limit }} or more.",
     *     invalidMessage = "This value should be a valid number."
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