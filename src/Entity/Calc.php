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
    protected $BaseConc = 0;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "Nicotine (booster) concentrate should be {{ limit }} or more.",
     *     maxMessage = "Nicotine (booster) concentrate should be {{ limit }} or less.",
     * )
     */
    protected $NicConc = 72;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "Needed concentrate should be {{ limit }} or more.",
     *     maxMessage = "Needed concentrate should be {{ limit }} or less.",
     * )
     */
    protected $FinalConc = 6;
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 0,
     *     max = 100000,
     *     minMessage = "Needed volume should be {{ limit }} or more.",
     * )
     */
    protected $FinalVol = 500;
    protected $NicVol;
    protected $BaseVol;

    public function getBaseConc()
    {
        return $this->BaseConc;
    }

    public function setBaseConc($BaseConc)
    {
        $this->BaseConc = $BaseConc;
    }

    public function getNicConc()
    {
        return $this->NicConc;
    }

    public function setNicConc($NicConc)
    {
        $this->NicConc = $NicConc;
    }

    public function getFinalConc()
    {
        return $this->FinalConc;
    }

    public function setFinalConc($FinalConc)
    {
        $this->FinalConc = $FinalConc;
    }

    public function getFinalVol()
    {
        return $this->FinalVol;
    }

    public function setFinalVol($FinalVol)
    {
        $this->FinalVol = $FinalVol;
    }

    public function getNicVol($FinalVol,$FinalConc,$BaseConc,$NicConc)
    {
        return $this->NicVol = ($FinalVol*($FinalConc-$BaseConc))/($NicConc-$BaseConc);
    }

    public function getBaseVol($FinalVol,$FinalConc,$BaseConc,$NicConc)
    {
        return $this->BaseVol = ($FinalVol*($FinalConc-$NicConc))/($BaseConc-$NicConc);
    }

}